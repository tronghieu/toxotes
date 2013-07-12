<?php 
/**
 * PostProperty
 *  This class has been auto-generated at 24/06/2013 23:21:05
 * @version		$Id$
 * @package		Model

 */

use Flywheel\Db\Type\DateTime;

require_once dirname(__FILE__) .'/Base/PostPropertyBase.php';
class PostProperty extends \PostPropertyBase {
    const
        BOOLEAN = 'BOOLEAN',
        INT = 'INT',
        FLOAT = 'FLOAT',
        DATETIME = 'DATETIME',
        TEXT = 'TEXT';

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