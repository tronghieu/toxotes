<?php
namespace SFS;

use Flywheel\Filesystem\Uploader;

class Upload {
    public static function crawlImgViaUrl($url, $dst_path, $context = null) {
        touch($dst_path);
        chmod($dst_path, 0777);
        return file_put_contents($dst_path, fopen($url, 'r'), null, $context);
    }

    public static function httpUpload($field, $options, &$error) {
        $origin_file_name = $_FILES[$field]['name'];
        $file_name = $options['use_filename']? $options['use_filename'] : $origin_file_name;

        $file_path = $options['bucket'] .'/'
//            .($options['hash_path']? substr(md5($origin_file_name), 0, 2) .'/' : '')
            .($options['use_filename']? $options['use_filename'] : $origin_file_name);

        $path = dirname($file_path);

        $real_file_path = MEDIA_DIR .'/' .$file_path;
        if (!self::makeFileStorageDir($real_file_path)) {
            Log::getInstance()->error("Can not make storage directory {$real_file_path}");
            return false;
        }

        if (!$options['overwrite'] && file_exists($real_file_path)) {
            return $file_path;
        }

        $uploader = new Uploader(dirname($real_file_path));
        $uploader->setFieldUpload($field);
        $uploader->setOverwriteIfExists($options['overwrite']);
        $uploader->setNameAfterUploaded(basename($file_name));
        $uploader->setFilterType('.jpg, .jpeg, .png, .bmp, .jpe');
        if ($uploader->upload()) {
            $data = $uploader->getData();
            $file_path = $path .'/' .$data['file_name'];
            return 'media/' .$file_path;
        } else {
            $error = $uploader->getError();
            Log::getInstance()->warning("Can not upload file", $error);
        }

        return false;
    }

    public static function uploadViaUrl($url, $options, &$error) {
        $urlInfo = parse_url($url);
        $file_name = basename($urlInfo['path']);

        $file_path = $options['bucket'] .'/'
//                .($options['hash_path']? substr(md5($urlInfo['path']), 0, 2) .'/' : '')
                .($options['use_filename']? $options['use_filename'] : $file_name);

        $real_file_path = MEDIA_DIR .'/' .$file_path;

        if (!self::makeFileStorageDir($real_file_path)) {
            Log::getInstance()->error("Can not make storage directory {$real_file_path}");
            return false;
        }

        if (!$options['overwrite'] && file_exists($real_file_path)) {
            Log::getInstance()->info("{$real_file_path} existed!");
            return 'media/' .$file_path;
        }

        if (self::crawlImgViaUrl($url, $real_file_path)) {
            return 'media/' .$file_path;
        } else {
            Log::getInstance()->warning("Can not crawl image via link: {$url}");
        }

        return false;
    }

    public static function makeFileStorageDir($file_path) {
        $path = dirname($file_path);
        if (is_dir($path)) {
            return true;
        }
        return mkdir($path, 0777, true);
    }

    public static function getFileSize($file_path) {
        $size = getimagesize($file_path, $info);
        $result = array(
            'width' => $size[0],
            'height' => $size[1],
            'mime' => $size['mime']
        );
        return $result;
    }
}