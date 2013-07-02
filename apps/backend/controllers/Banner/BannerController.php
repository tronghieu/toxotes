<?php

use Flywheel\Factory;
use Flywheel\Filesystem\Uploader;

class BannerController extends AdminBaseController {
    public function executeDefault() {
        $error = Factory::getSession()->getFlash('banner_error');
        $message = Factory::getSession()->getFlash('banner');
        $q = Banner::read();

        $filter = $this->request()->post('filter', 'ARRAY', array());
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

        $banners = $q->execute()->fetchAll(\PDO::FETCH_CLASS, 'Banner', array(null, false));

        $this->view()->assign(array(
            'banners' => $banners,
            'error' => $error,
            'message' => $message,
            'filter' => $filter
        ));

        return $this->renderComponent();
    }

    public function executeNew() {
        $error = array();
        $banner = new Banner();
        if ($this->request()->isPostRequest()) {
            if ($this->_save($banner, $error)) {
                Factory::getSession()->setFlash('banner', t($banner->getTitle() .' was saved'));
                $this->redirect($this->createUrl('banner/default'));
            }
        }

        $this->setView('form');
        $this->view()->assign(array(
            'banner' => $banner,
            'error' => $error,
            'upload_max_filesize' => str_replace('M','', ini_get('upload_max_filesize'))
        ));

        return $this->renderComponent();
    }

    public function executeEdit() {
        if (!($banner = Banner::retrieveById($this->request()->get('id')))) {
            Factory::getSession()->setFlash('banner_error', t('Banner not found'));
            $this->redirect($this->createUrl('banner/default'));
        }

        $message = Factory::getSession()->getFlash('banner');

        $error = array();
        if ($this->request()->isPostRequest()) {
            if ($this->_save($banner, $error)) {
                Factory::getSession()->setFlash('banner', t($banner->getTitle()) .' was saved');
                $this->redirect($this->createUrl('banner/edit', array('id' => $banner->getId())));
            }
        }

        $this->setView('form');
        $this->view()->assign(array(
            'banner' => $banner,
            'error' => $error,
            'upload_max_filesize' => str_replace('M','', ini_get('upload_max_filesize'))
        ));

        return $this->renderComponent();
    }

    public function executeRemove() {
        $this->validAjaxRequest();
        $res = new AjaxResponse();

        if (!($banner = Banner::retrieveById($this->request()->get('id')))) {
            $res->type = AjaxResponse::ERROR;
            $res->message = t('Banner not found');
            return $this->renderText($res->toString());
        }

        $banner->delete();
        $res->type = AjaxResponse::SUCCESS;
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
                \Flywheel\Util\Folder::create($upload_dir, 0777);
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