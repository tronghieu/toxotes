<?php
use Flywheel\Config\ConfigHandler;
use Flywheel\Filesystem\Uploader;
use Flywheel\Util\Folder;

class PostFilesController extends AdminBaseController {
    public function executeDefault() {}

    public function executeUpload() {
        $upload_max_filesize = str_replace('M', '', ini_get('upload_max_filesize'));
        $res = new AjaxResponse();
        $postId = $this->request()->post('post_id');

        $upload_dir = PUBLIC_DIR .'/media/attachment/';
        Folder::create($upload_dir, 0777);
        $error = array();

        $fileUploader = new Uploader($upload_dir, 'file_upload');
        $fileUploader->setMaximumFileSize($upload_max_filesize);
        $fileUploader->setFilterType(ConfigHandler::get('upload_allow'));
        $fileUploader->setIsEncryptFileName(false);
        if ($fileUploader->upload('upload_files')) {
            $data = $fileUploader->getData();
            $filePath = '/media/attachment/' .$data['file_name'];
            $fileUrl = $this->document()->getBaseUrl() .'/../' .$filePath;

            $postFile = new PostAttachments();
            $postFile->setPostId($postId);
            $postFile->setFile($filePath);
            $postFile->setFileName($data['file_name']);
            $postFile->setMimeType($fileUploader->getMimeTypeByExtension($data['file_extension']));

            if ($postFile->save()) {
                $res->type = AjaxResponse::SUCCESS;
                $res->postFile = $postFile->toArray();
                return $this->renderText($res->toString());
            } else {
                foreach ($postFile->getValidationFailures() as $validationFailure) {
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
}