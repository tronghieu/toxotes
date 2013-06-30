<?php

use Flywheel\Filesystem\Uploader;

class BannerController extends AdminBaseController {
    public function executeDefault() {
        $banners = Banner::findAll();

        $this->view()->assign(array(
            'banners' => $banners
        ));
    }

    public function executeNew() {
        $error = array();
        $banner = new Banner();
        if ($this->request()->isPostRequest()) {
            if ($this->_save($banner, $error)) {
                \Flywheel\Factory::getSession()->setFlash('banner', t($banner->getTitle() .' was saved'));
                $this->redirect($this->createUrl('banner/default'));
            }
        }

        $this->setView('form');
        $this->view()->assign(array(
            'banner' => $banner,
            'error' => $error
        ));

        return $this->renderComponent();
    }

    public function executeEdit() {
        if (!($banner = Banner::retrieveById($this->request()->get('id')))) {
            \Flywheel\Factory::getSession()->setFlash('banner_error', t('Banner not found'));
        }

        $error = array();
        if ($this->request()->isPostRequest()) {
            $this->_save($banner, $error);
        }

        $this->setView('form');
        $this->view()->assign(array(
            'banner' => $banner,
            'error' => $error
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
        $res->message = t('Banner ' .$banner->getTitle() .' was removed!');
        return $this->renderText($res->toString());
    }

    public function _save(\Banner $banner, &$error = array()) {
        $banner->hydrate($this->request()->post('input', 'ARRAY', array()));
        $file_upload = @$_FILES['file_upload']['tmp_name'];
        if ($banner->isNew() && null == $file_upload) {
            @$error['banner.file'] = t('Banner file is required!');
        }

        if (empty($error)) {
            //upload file
            if ($file_upload) {
                $upload_dir = PUBLIC_DIR .'/media/banner';
                \Flywheel\Util\Folder::create($upload_dir, 0777);
                $fileUploader = new Uploader(PUBLIC_DIR .'/media/banner/', 'file_upload');
                $fileUploader->setMaximumFileSize(2);
                $fileUploader->setFilterType('.jpg, .jpeg, .png, .bmp, .gif');
                $fileUploader->setIsEncryptFileName(true);
                if($fileUploader->upload()) {
                    $data = $fileUploader->getData();
                    $banner->setFile('/media/' .$data['file_name']);
                } else {
                    $uploadErr = $fileUploader->getError();
                    $error['banner.file'] = $uploadErr;
                }
            }

            if ($banner->save()) {
                return true;
            }

            foreach ($banner->getValidationFailures() as $validationFailure) {
                $error[$validationFailure->getColumn()] = $validationFailure->getMessage();
            }
        }
        return false;
    }
}