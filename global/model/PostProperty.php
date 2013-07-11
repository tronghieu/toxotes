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

    /**
     * @return bool|float|DateTime|int|string
     */
    public function getValue() {
        $type = $this->getValueType();
        switch ($type) {
            case 'BOOLEAN' :
                return (boolean) $this->getBooleanValue();
            case 'INT' :
                return (int) $this->getIntValue();
            case 'FLOAT' :
                return (float) $this->getFloatValue();
            case 'DATETIME' :
                return new DateTime($this->getDatetimeValue());
            default:
                return $this->getTextValue();
        }
    }
}