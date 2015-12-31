<?php
namespace CMSBackend\Controller;


use Flywheel\Filesystem\Uploader;
use Flywheel\Session\Session;
use Flywheel\Util\Folder;

class Banner extends CMSBackendBase {
    public function executeDefault() {
        $this->setView('Banner/default');
        $session = Session::getInstance();
        $error = $session->getFlash('banner_error');
        $message = $session->getFlash('banner');
        $q = \Banner::select();

        $filter = $this->get('filter', 'ARRAY', array());
        if (isset($filter['keyword']) && '' != $filter['keyword']) {
            $q->andWhere('`title` LIKE "%' .$filter['keyword'] .'%"');
        }

        if (isset($filter['term_id']) && 0 != $filter['term_id']) {
            $q->andWhere('`term_id`= :term_id')
                ->setParameter(':term_id', $filter['term_id'], \PDO::PARAM_INT);
        }

        if (isset($filter['status']) && 'All' != $filter['status']) {
            $q->andWhere('`status` = :status')
                ->setParameter(':status', $filter['status'], \PDO::PARAM_STR);
        }

        $banners = $q->orderBy('term_id')
            ->addOrderBy('ordering')
            ->execute();

        $this->view()->assign(array(
            'banners' => $banners,
            'error' => $error,
            'message' => $message,
            'filter' => $filter
        ));

        return $this->renderComponent();
    }

    public function executeNew() {
        $this->setView('Banner/form');
        $error = array();
        $banner = new \Banner();
        if ($this->request()->isPostRequest()) {
            if ($this->_save($banner, $error)) {
                Session::getInstance()->setFlash('banner', t($banner->getTitle() .' was saved'));
                $this->redirect($this->createUrl('banner/default'));
            }
        }

        $this->view()->assign(array(
            'banner' => $banner,
            'error' => $error,
            'upload_max_filesize' => str_replace('M','', ini_get('upload_max_filesize'))
        ));

        return $this->renderComponent();
    }

    public function executeEdit() {
        $this->setView('Banner/form');
        if (!($banner = \Banner::retrieveById($this->request()->get('id')))) {
            Session::getInstance()->setFlash('banner_error', t('Banner not found'));
            $this->redirect($this->createUrl('banner/default'));
        }

        $message = Session::getInstance()->getFlash('banner');

        $error = array();
        if ($this->request()->isPostRequest()) {
            if ($this->_save($banner, $error)) {
                Session::getInstance()->setFlash('banner', t($banner->getTitle()) .' was saved');
                $this->redirect($this->createUrl('banner/edit', array('id' => $banner->getId())));
            }
        }

        $this->view()->assign(array(
            'banner' => $banner,
            'error' => $error,
            'message' => $message,
            'upload_max_filesize' => str_replace('M','', ini_get('upload_max_filesize'))
        ));

        return $this->renderComponent();
    }

    public function executeRemove() {
        $this->validAjaxRequest();
        $res = new \AjaxResponse();

        if (!($banner = \Banner::retrieveById($this->request()->get('id')))) {
            $res->type = \AjaxResponse::ERROR;
            $res->message = t('Banner not found');
            return $this->renderText($res->toString());
        }

        $banner->delete();
        $res->type = \AjaxResponse::SUCCESS;
        $res->id = $banner->getId();
        $res->banner = $banner->toArray();
        $res->message = t('Banner ' .$banner->getTitle() .' was removed!');
        return $this->renderText($res->toString());
    }

    public function _save(\Banner $banner, &$error = array()) {
        $banner->hydrate($this->request()->post('input', 'ARRAY', array()));
        $file_upload = @$_FILES['file_upload']['tmp_name'];
        if ($banner->isNew() && null == $file_upload) {
            @$error['banner.file'] = t('Banner file is required!');
        }

        if (!$banner->getTermId()) {
            @$error['banner.term_id'] = t('Banner group is required!');
        }

        if (empty($error)) {
            //upload file
            if ($file_upload) {
                $upload_dir = PUBLIC_DIR .'/media/banner';
                Folder::create($upload_dir, 0777);
                $fileUploader = new Uploader(PUBLIC_DIR .'/media/banner/', 'file_upload');
                $fileUploader->setMaximumFileSize(ini_get('upload_max_filesize'));
                $fileUploader->setFilterType('.jpg, .jpeg, .png, .bmp, .gif');
                $fileUploader->setIsEncryptFileName(true);
                if($fileUploader->upload()) {
                    $data = $fileUploader->getData();
                    $banner->setFile('/media/banner/' .$data['file_name']);
                } else {
                    $uploadErr = $fileUploader->getError();
                    $error['banner.file'] = implode('.' ,$uploadErr);
                }
            }

            if (empty($error) && $banner->save()) {
                return true;
            }

            foreach ($banner->getValidationFailures() as $validationFailure) {
                $error[$validationFailure->getColumn()] = $validationFailure->getMessage();
            }
        }
        return false;
    }
} 