<?php 
/**
 * TermCustomFields
 *  This class has been auto-generated at 19/06/2013 07:00:43
 * @version		$Id$
 * @package		Model

 */

use Flywheel\Util\Slugify;

require_once dirname(__FILE__) .'/Base/TermCustomFieldsBase.php';
class TermCustomFields extends \TermCustomFieldsBase {
    public function validationRules() {
        self::$_validate['name'][] = array(
            'name' => 'Require',
            'message' => "Name can not be blank!");

        self::$_validate['field_key'][] = array(
            'name' => 'Match',
            'value' => '/^[a-z0-9_-]{3,16}$/',
            'message' => "Field key format is not valid!");

        self::$_validate['field_key'][] = array(
            'name' => 'Require',
            'message' => "Field's key can not be blank!");

        self::$_validate['term_id'][] = array(
            'name' => 'Require',
            'message' => "Term's id format is not valid!");
    }

    protected function _beforeSave() {
        if (!$this->getFieldKey()) {
            $this->setFieldKey(Slugify::filter($this->getName()));
        }
        parent::_beforeSave();
    }
}