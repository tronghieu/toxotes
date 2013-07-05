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
        $postId = $this->request()->post('post_id');
        $upload_dir = PUBLIC_DIR .'/media/post_img/';
        Folder::create($upload_dir, 0777);
        $fileUploader = new Uploader($upload_dir, 'file_upload');
        $fileUploader->setMaximumFileSize($upload_max_filesize);
        $fileUploader->setFilterType('.jpg, .jpeg, .png, .bmp, .gif');
        $fileUploader->setIsEncryptFileName(true);
        if ($fileUploader->upload('upload_images')) {
            $data = $fileUploader->getData();
            $filePath = '/media/post_img/' .$data['file_name'];
            $fileUrl = $this->document()->getBaseUrl() .'/../' .$filePath;


            return $this->renderText(json_encode(array(
                'file' => $fileUrl
            )));
        }

        return $this->renderText('Not ok');

        $uploader = new AjaxUploadHandler(
            array(
                'param_name' => 'upload_images',
                'upload_dir' => $upload_dir,
                'upload_url' => $this->document()->getDomain() .'/media/post_img/'
            ),
            false
        );

        $result = $uploader->post(false);
        var_dump($result); exit;
        $res = new AjaxResponse();
        $res->result = $result;
        return $this->renderText($res->toString());
    }

    public function executeMakeStar() {}

    public function executeEdit() {}

    public function executeRemove() {}
}