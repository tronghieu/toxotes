<?php 
/**
 * WidgetBlock
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/WidgetBlockBase.php';
class WidgetBlock extends \WidgetBlockBase {
    public function validationRules() {
        self::$_validate['name'][] = array(
            'name' => 'Require',
            'message' => "name can not be blank!");

        self::$_validate['position'][] = array(
            'name' => 'Require',
            'message' => "position can not be blank!");

        self::$_validate['path'][] = array(
            'name' => 'Require',
            'message' => "path can not be blank!");
    }
}