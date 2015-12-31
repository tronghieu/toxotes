<?php
namespace CMSBackend\Controller;

use Flywheel\Filesystem\Uploader;
use Flywheel\Util\Folder;

class Media extends CMSBackendBase {
    public function executeDefault()
    {
        // TODO: Implement executeDefault() method.
    }

    public function executeUpload()
    {
        $upload_max_filesize = str_replace('M', '', ini_get('upload_max_filesize'));
        $res = new \AjaxResponse();

        $upload_dir = PUBLIC_DIR .'/media/editor_upload/';
        Folder::create($upload_dir, 0777);
        $error = array();

        $fileUploader = new Uploader($upload_dir, 'file_upload');
        $fileUploader->setMaximumFileSize($upload_max_filesize);
        $fileUploader->setFilterType('.jpg, .jpeg, .png, .bmp, .gif');
        $fileUploader->setIsEncryptFileName(true);
        if ($fileUploader->upload('file_upload')) {
            $data = $fileUploader->getData();
            $file_path = '/media/editor_upload/' .$data['file_name'];
            $file_url = rtrim($this->document()->getBaseUrl(), '/'). preg_replace('/(\/+)/','/', '/../' .$file_path);

            $image = [
                'file_name' => $data['file_name'],
                'url' => $file_url,
                'path' => $file_path,
            ];

            $res->type = \AjaxResponse::SUCCESS;
            $res->image = $image;
            return $this->renderText($res->toString());

        } else {
            $error['upload'] = $fileUploader->getError();
        }

        $res->type = \AjaxResponse::ERROR;
        $res->error = $error;

        return $this->renderText($res->toString());
    }
}