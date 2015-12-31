<?php 
/**
 * PostProperty
 * @version		$Id$
 * @package		Model

 */

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

    /**
     * @param $property
     * @param $postId
     * @return \PostProperty
     */
    public static function retrieveByPropertyAndPostId($property, $postId) {
        foreach(self::$_instances as $instance) {
            /** @var PostProperty $instance */
            if ($instance->getProperty() == $property
                && $instance->getPostId() == $postId) {
                return $instance;
            }
        }

        $obj = self::findOneByPostIdAndProperty($postId, $property);
        if ($obj) {
            self::addInstanceToPool($obj, $obj->getId());
        }

        return $obj;
    }
}