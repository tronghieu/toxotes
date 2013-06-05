<?php 
/**
 * TermProperty
 *  This class has been auto-generated at 04/06/2013 14:44:47
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/TermPropertyBase.php';
class TermProperty extends \TermPropertyBase {
    public function setValue($value, $type)  {
        switch ($type) {
            case 'BOOLEAN' :
                $this->setBoleanValue((boolean) $value);
                break;
            case 'INT':
                $this->setIntValue($value);
                break;
            case 'FLOAT':
                $this->setFloatValue($value);
                break;
            case 'DATETIME':
                $this->setDatetimeValue(new \Flywheel\Db\Type\DateTime($value));
                break;
            default:
                $this->setTextValue((string) $value);
        }
    }
}