<?php 
/**
 * PostImages
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/PostImagesBase.php';
class PostImages extends \PostImagesBase {
    /**
     * init
     */
    public function init() {
        parent::init();
        $this->attachBehavior(
            'TimeStamp', new \Flywheel\Model\Behavior\TimeStamp(), array(
                'create_attr' => 'created_time',
                'modify_attr' => 'modified_time'
            )
        );
    }

    /**
     * Get thumb image by dimension
     *
     * @param $width
     * @param null $height
     * @param string $mode
     * @return string
     */
    public function getThumbs($width, $height = null, $mode = 'a') {
        $media_cfg = \Flywheel\Config\ConfigHandler::get('media');
        $site_url = \Setting::get('site_url');

        if (!$media_cfg['sfs_enable']) {
            return $site_url .$this->getPath();
        }

        if (!$width && $height) {
            $width = $height;
            $height = null;
        }

        $func = ($height && ($width == $height))?  'square/' : 'resize/';
        $thumb_url = $media_cfg['sfs_path'] .'/cache/' .$func .
            (($func == 'resize/')?
                "w_{$width}-h_{$height}-m_{$mode}/" :
                "w_{$width}/")
            .$this->getPath();
        return rtrim($site_url, '/') .preg_replace('/(\/+)/','/',$thumb_url);
    }

    /**
     * Get image url
     *
     * @return string
     */
    public function getUrl() {
        $site_url = \Setting::get('site_url');
        return $site_url .$this->getPath();
    }

    public function afterDelete()
    {
        @unlink(\Flywheel\Util\Folder::clean(MEDIA_DIR .$this->getPath()));
        return parent::afterDelete();
    }


}