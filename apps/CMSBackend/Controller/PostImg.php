<?php
namespace CMSBackend\Controller;


use Flywheel\Filesystem\Uploader;
use Flywheel\Util\Folder;

class PostImg extends CMSBackendBase {
    public function executeDefault() {}

    public function executeUpload() {
        $upload_max_filesize = str_replace('M', '', ini_get('upload_max_filesize'));
        $res = new \AjaxResponse();
        $postId = $this->request()->post('post_id');

        $upload_dir = PUBLIC_DIR .'/media/post_img/';
        Folder::create($upload_dir, 0777);
        $error = array();

        $fileUploader = new Uploader($upload_dir, 'file_upload');
        $fileUploader->setMaximumFileSize($upload_max_filesize);
        $fileUploader->setFilterType('.jpg, .jpeg, .png, .bmp, .gif');
        $fileUploader->setIsEncryptFileName(true);
        if ($fileUploader->upload('upload_images')) {
            $data = $fileUploader->getData();
            $filePath = '/media/post_img/' .$data['file_name'];
            $fileUrl = $this->document()->getBaseUrl() .'/../' .$filePath;

            $otherImages = \PostPeer::getPostImg($postId);
            $ordering = sizeof($otherImages);
            foreach($otherImages as $image) {
                if ($image->getOrdering() > $ordering) {
                    $ordering = $image->getOrdering();
                }
            }

            $ordering++;

            $postImg  = new \PostImages();
            $postImg->setPath($filePath);
            $postImg->setPostId($postId);
            $postImg->setOrdering($ordering);

            if (!\PostPeer::getPostMainImg($postId)) {
                $postImg->setIsMain(true);
            }

            if ($postImg->save()) {
                $res->type = \AjaxResponse::SUCCESS;
                $t = $postImg->toArray();
                $t['thumb_url'] = $postImg->getThumbs(96, 96);
                $t['url'] = $postImg->getUrl();
                $res->postImage = $t;
                return $this->renderText($res->toString());
            } else {
                foreach ($postImg->getValidationFailures() as $validationFailure) {
                    $error[$validationFailure->getColumn()] = $validationFailure->getMessage();
                }
            }
        } else {
            $error['upload'] = $fileUploader->getError();
        }

        $res->type = \AjaxResponse::ERROR;
        $res->error = $error;

        return $this->renderText($res->toString());
    }

    public function executeMakeStar() {
        $this->validAjaxRequest();
        $res = new \AjaxResponse();

        if (!($postImg = \PostImages::retrieveById($this->post('id')))) {
            $res->type = \AjaxResponse::ERROR;
            $res->message = t("Image not found");
            return $this->renderText($res->toString());
        }

        if (!$postImg->getIsMain()) {
            $postImg->beginTransaction();
            try {
                $currentMain = \PostPeer::getPostMainImg($postImg->getPostId());
                $postImg->setIsMain(true);
                if ($postImg->save(false)) {
                    $currentMain->setIsMain(false);
                    $currentMain->save(false);
                }
                $postImg->commit();
            } catch(\Exception $e) {
                $postImg->rollBack();
                throw $e;
            }
        }

        $result = [];
        $images = \PostPeer::getPostImg($postImg->getPostId());
        foreach($images as $image) {
            $t = $image->toArray();
            $t['thumb_url'] = $image->getThumbs(96,96);
            $t['url'] = $image->getUrl();
            $result[] = $t;
        }

        $res->images = $result;
        $res->type = \AjaxResponse::SUCCESS;
        return $this->renderText($res->toString());
    }

    public function executeUpdate() {
        $this->validAjaxRequest();
        $res = new \AjaxResponse();

        if (!($postImg = \PostImages::retrieveById($this->post('id')))) {
            $res->type = \AjaxResponse::ERROR;
            $res->message = t("Image not found");
            return $this->renderText($res->toString());
        }

        $ordering = $this->post('ordering', 'INT', 0);
        $caption = $this->post('caption');
        $postImg->setOrdering($ordering);
        $postImg->setCaption($caption);
        if ($postImg->save()) {
            $res->message = t('OK');
            $res->image = $postImg->toArray();
            $res->image['thumb_url'] = $postImg->getThumbs(96,96);
            $res->image['url'] = $postImg->getUrl();
            $res->type = \AjaxResponse::SUCCESS;
        } else {
            $res->message = t('Fail when save image');
            $res->error = [];
            foreach($postImg->getValidationFailures() as $fail) {
                $res->error[$fail->getColumn(false)] = $fail->getMessage();
            }
            $res->type = \AjaxResponse::ERROR;
        }

        return $this->renderText($res->toString());
    }

    public function executeRemove() {
        $this->validAjaxRequest();
        $res = new \AjaxResponse();

        if (!($postImg = \PostImages::retrieveById($this->request()->post('id')))) {
            $res->type = \AjaxResponse::ERROR;
            $res->message = t("Image not found");
            return $this->renderText($res->toString());
        }

        if ($postImg->delete()) {
            $otherImages = [];
            if (($otherImages = \PostPeer::getPostImg($postImg->getPostId())) && $postImg->getIsMain()) {
                $otherImages[0]->setIsMain(true);
                $otherImages[0]->save();
            }

            $result = [];
            foreach($otherImages as $image) {
                $t = $image->toArray();
                $t['thumb_url'] = $image->getThumbs(96, 96);
                $t['url'] = $image->getUrl();
                $result[] = $t;
            }

            $res->images = $result;
            $res->postImg = $postImg->toArray();
            $res->type = \AjaxResponse::SUCCESS;

            return $this->renderText($res->toString());
        }

        $res->type = \AjaxResponse::ERROR;
        $res->message = t("Unknown error");
        return $this->renderText($res->toString());
    }
} 