<?php 
/**
 * Banner
 *  This class has been auto-generated at 30/06/2013 06:04:52
 * @version		$Id$
 * @package		Model

 */

use Flywheel\Db\Type\DateTime;

require_once dirname(__FILE__) .'/Base/BannerBase.php';
class Banner extends \BannerBase {
    public function validationRules() {
        self::$_validate['file'][] = array(
            'name' => 'Require',
            'message' => "Banner file can not be blank!");

        self::$_validate['title'][] = array(
            'name' => 'Require',
            'message' => 'Banner title can not be blank!',
        );

        self::$_validate['term_id'][] = array(
            'name' => 'Require',
            'message' => 'Banner group is required!',
        );

        self::$_validate['ordering'][] = array(
            'name' => 'Type',
            'value' => 'integer',
            'message' => 'Ordering must be a integer number!',
        );

        self::$_validate['width'][] = array(
            'name' => 'Type',
            'value' => 'integer',
            'message' => 'Width must be a integer number!',
        );

        self::$_validate['height'][] = array(
            'name' => 'Type',
            'value' => 'integer',
            'message' => 'Height must be a integer number!',
        );
    }

    protected function _beforeSave() {
        if ($this->isNew()) {
            $this->setCreatedDate(new DateTime());
        }
        $this->setModifiedTime(new DateTime());
    }
}