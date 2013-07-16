<?php 
/**
 * TermProperty
 *  This class has been auto-generated at 04/06/2013 14:44:47
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/TermPropertyBase.php';
class TermProperty extends \TermPropertyBase {
    const
        BOOLEAN = 'BOOLEAN',
        INT = 'INT',
        FLOAT = 'FLOAT',
        DATETIME = 'DATETIME',
        TEXT = 'TEXT';

    public function setValue($value, $type)  {
        switch ($type) {
            case 'BOOLEAN' :
                $this->setBooleanValue((boolean) $value);
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

    /**
     * @return bool|float|DateTime|int|string
     */
    public function getValue() {
        $type = $this->getValueType();
        switch ($type) {
            case self::BOOLEAN :
                return (boolean) $this->getBooleanValue();
            case self::INT :
                return (int) $this->getIntValue();
            case self::FLOAT :
                return (float) $this->getFloatValue();
            case self::DATETIME :
                return new DateTime($this->getDatetimeValue());
            case self::TEXT:
            default:
                return $this->getTextValue();
        }
    }
}