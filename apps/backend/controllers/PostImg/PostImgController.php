<?php
use Flywheel\Filesystem\Uploader;
use Flywheel\Util\Folder;

/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 7/5/13
 * Time: 12:39 AM
 * To change this template use File | Settings | File Templates.
 */

class PostImgController extends AdminBaseController {
    public function executeDefault() {}

    public function executeUpload() {
        $upload_max_filesize = str_replace('M', '', ini_get('upload_max_filesize'));
        $res = new AjaxResponse();
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

            $postImg  = new PostImages();
            $postImg->setPath($filePath);
            $postImg->setPostId($postId);

            if (!PostPeer::getPostMainImg($postId)) {
                $postImg->setIsMain(true);
            }

            if ($postImg->save()) {
                $res->type = AjaxResponse::SUCCESS;
                $res->postImage = $postImg->toArray();
                return $this->renderText($res->toString());
            } else {
                foreach ($postImg->getValidationFailures() as $validationFailure) {
                    $error[$validationFailure->getColumn()] = $validationFailure->getMessage();
                }
            }
        } else {
            $error['upload'] = $fileUploader->getError();
        }

        $res->type = AjaxResponse::ERROR;
        $res->error = $error;

        return $this->renderText($res->toString());
    }

    public function executeMakeStar() {}

    public function executeEdit() {}

    public function executeRemove() {}
}