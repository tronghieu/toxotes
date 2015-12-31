<?php 
/**
 * Banner
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/BannerBase.php';
class Banner extends \BannerBase {
    public function init() {
        parent::init();
        $this->attachBehavior(
            'TimeStamp', new \Flywheel\Model\Behavior\TimeStamp(), array(
                'create_attr' => 'created_time',
                'modify_attr' => 'modified_time'
            )
        );
    }

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
}