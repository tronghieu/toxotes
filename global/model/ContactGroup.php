<?php 
/**
 * ContactGroup
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/ContactGroupBase.php';
class ContactGroup extends \ContactGroupBase {
    public function validationRules() {
        self::$_validate['name'][] = array(
            'name' => 'Require',
            'message' => "name can not be blank!");
    }

    protected function _beforeSave() {
        if (!$this->slug || $this->isColumnModified('name')) {
            $this->setSlug(\Flywheel\Util\Slugify::filter($this->getName()));
        }
    }
}