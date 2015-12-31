<?php 
/**
 * Items
 * @version		$Id$
 * @package		Model

 */

use Flywheel\Db\Type\DateTime;

require_once dirname(__FILE__) .'/Base/ItemsBase.php';
class Items extends \ItemsBase {
    const STATUS_ACTIVE = 'ACTIVE',
        STATUS_INACTIVE = 'INACTIVE';

    /**
     * @var array
     */
    protected $_images = [];

    /**
     * Item's images in array
     * image's structure:
     * file_name => [
     *      'file_name' => file's name included extension
     *      'path' => path.to.file.from.media.folder
     *      'public' => true|false (show at frontend?)
     *      'main' => true|false (item's main image)
     *      'ordering' =>
     * ]
     *
     * @return array
     */
    public function getImages() {
        if (empty($this->_images) && $this->getImgs()) {
            $images = json_decode($this->getImgs(), true);
            uasort($images, function($a, $b) {
                if (!isset($a['ordering'])) {
                    $a['ordering'] = 0;
                }

                if (!isset($b['ordering'])) {
                    $b['ordering'] = 0;
                }

                if ($a['ordering'] == @$b['ordering']) {
                    return 0;
                }
                return ($a['ordering'] < $b['ordering']) ? -1 : 1;
            });
            $this->_images = $images;
        }

        return $this->_images;
    }

    /**
     * Get item's main img in array
     * returning data @see Items::getImages()
     * [
     *      'file_name' => file's name included extension
     *      'path' => path.to.file.from.media.folder
     *      'public' => true|false (show at frontend?)
     *      'main' => true|false (item's main image)
     *      'ordering' =>
     * ]
     *
     * @return array|null
     */
    public function getMainImgData() {
        $images = $this->getImages();
        if (empty($images)) {
            return null;
        }

        foreach($images as $img) {
            if ($img['main']) {
                return $img;
            }
        }

        return array_shift($images);
    }

    /**
     * Get main img thumb
     *
     * @param $width
     * @param null $height
     * @param string $mode
     * @return string
     */
    public function getMainImgThumb($width, $height = null, $mode = 'a') {
        $main = $this->getMainImgData();
        if ($main) {
            $path = $main['path'];
            return self::getImgThumbFromPath($path, $width, $height, $mode);
        }

        return '';
    }

    /**
     * Get img thumb url from file path
     *
     * @param $path
     * @param $width
     * @param null $height
     * @param string $mode
     * @return string
     */
    public static function getImgThumbFromPath($path, $width, $height = null, $mode = 'a') {
        $media_cfg = \Flywheel\Config\ConfigHandler::get('media');
        $site_url = \Setting::get('site_url');

        if (!$media_cfg['sfs_enable']) {
            return $site_url .$path;
        }

        if (!$width && $height) {
            $width = $height;
            $height = null;
        }

        $func = ($width && $height)? 'resize/' : 'square/';
        $thumb_url = $media_cfg['sfs_path'] .'/cache/' .$func .
            (($func == 'resize/')?
                "w_{$width}-h_{$height}-m_{$mode}/" :
                "w_{$width}/")
            .$path;
        return rtrim($site_url, '/') .preg_replace('/(\/+)/','/',$thumb_url);
    }

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
     * Customs validation rules
     */
    public function validationRules() {
        self::$_validate['name'][] = array(
            'name' => 'Require',
            'message' => "Name can not be blank!");

        self::$_validate['cat_id'][] = array(
            'name' => 'MinValue',
            'value' => '1',
            'message' => 'Product category is required!',
        );
    }

    /**
     * Check item's draft
     * @return bool
     */
    public function isDraft()
    {
        return (bool) $this->getIsDraft();
    }

    /**
     * Add image
     * @param $image
     */
    public function addImage($image)
    {
        $images = $this->getImages();
        $images[$image['file_name']] = $image;
        $this->_images = $images;
    }

    /**
     * Remove item's image
     *
     * @param $file_name
     */
    public function removeImage($file_name)
    {
        $images = $this->getImages();
        $main_img = $this->getMainImgData();
        if ($file_name == $main_img['file_name']) {
            //fuck remove main image
            foreach($images as $file => $data) {
                if ($file != $file_name) {
                    $images[$file]['main'] = true;
                    break;
                }
            }
        }
        unset($images[$file_name]);
        $this->_images = $images;
    }

    /**
     * Set main image
     *
     * @param $file_name
     */
    public function setMainImage($file_name)
    {
        $images = $this->getImages();
        if (isset($images[$file_name])) {
            foreach($images as $file => $data) {
                if ($file == $file_name) {
                    $images[$file]['main'] = true;
                } else {
                    $images[$file]['main'] = false;
                }
            }

        }
        $this->_images = $images;
    }

    /**
     * Get Cat
     * @return bool|Terms
     */
    public function getCat()
    {
        if ($this->getCatId()) {
            return \Terms::retrieveById($this->getCatId());
        }

        return false;
    }

    /**
     * Overwrite
     * @return \Flywheel\Event\Event
     */
    protected function _beforeSave() {
        if ($this->getName()) {
            $this->setSlug(\Flywheel\Util\Slugify::filter($this->getName()));
        }

        if (!($this->getPublicTime() instanceof DateTime) || $this->getPublicTime()->isEmpty()) {
            $this->setPublicTime(new DateTime());
        }

        if (!empty($this->_images)) {
            $this->setImgs(json_encode($this->_images));
        }

        return parent::_beforeSave();
    }
}