<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * ItemProperty
 *  This class has been auto-generated at 22/04/2013 18:00:34
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $item_id item_id type : int(11)
 * @property string $property property type : varchar(255) max_length : 255
 * @property string $text_value text_value type : text max_length : 
 * @property integer $int_value int_value type : int(11)
 * @property number $float_value float_value type : decimal(20,2)
 * @property integer $boolean_value boolean_value type : tinyint(1)
 * @property datetime $datetime_value datetime_value type : datetime
 * @property integer $ordering ordering type : int(11)

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \ItemProperty[] findById(integer $id) find objects in database by id
 * @method static \ItemProperty findOneById(integer $id) find object in database by id
 * @method static \ItemProperty retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setItemId(integer $item_id) set item_id value
 * @method integer getItemId() get item_id value
 * @method static \ItemProperty[] findByItemId(integer $item_id) find objects in database by item_id
 * @method static \ItemProperty findOneByItemId(integer $item_id) find object in database by item_id
 * @method static \ItemProperty retrieveByItemId(integer $item_id) retrieve object from poll by item_id, get it from db if not exist in poll

 * @method void setProperty(string $property) set property value
 * @method string getProperty() get property value
 * @method static \ItemProperty[] findByProperty(string $property) find objects in database by property
 * @method static \ItemProperty findOneByProperty(string $property) find object in database by property
 * @method static \ItemProperty retrieveByProperty(string $property) retrieve object from poll by property, get it from db if not exist in poll

 * @method void setTextValue(string $text_value) set text_value value
 * @method string getTextValue() get text_value value
 * @method static \ItemProperty[] findByTextValue(string $text_value) find objects in database by text_value
 * @method static \ItemProperty findOneByTextValue(string $text_value) find object in database by text_value
 * @method static \ItemProperty retrieveByTextValue(string $text_value) retrieve object from poll by text_value, get it from db if not exist in poll

 * @method void setIntValue(integer $int_value) set int_value value
 * @method integer getIntValue() get int_value value
 * @method static \ItemProperty[] findByIntValue(integer $int_value) find objects in database by int_value
 * @method static \ItemProperty findOneByIntValue(integer $int_value) find object in database by int_value
 * @method static \ItemProperty retrieveByIntValue(integer $int_value) retrieve object from poll by int_value, get it from db if not exist in poll

 * @method void setFloatValue(number $float_value) set float_value value
 * @method number getFloatValue() get float_value value
 * @method static \ItemProperty[] findByFloatValue(number $float_value) find objects in database by float_value
 * @method static \ItemProperty findOneByFloatValue(number $float_value) find object in database by float_value
 * @method static \ItemProperty retrieveByFloatValue(number $float_value) retrieve object from poll by float_value, get it from db if not exist in poll

 * @method void setBooleanValue(integer $boolean_value) set boolean_value value
 * @method integer getBooleanValue() get boolean_value value
 * @method static \ItemProperty[] findByBooleanValue(integer $boolean_value) find objects in database by boolean_value
 * @method static \ItemProperty findOneByBooleanValue(integer $boolean_value) find object in database by boolean_value
 * @method static \ItemProperty retrieveByBooleanValue(integer $boolean_value) retrieve object from poll by boolean_value, get it from db if not exist in poll

 * @method void setDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) setDatetimeValue(string $datetime_value) set datetime_value value
 * @method \Flywheel\Db\Type\DateTime getDatetimeValue() get datetime_value value
 * @method static \ItemProperty[] findByDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) findByDatetimeValue(string $datetime_value) find objects in database by datetime_value
 * @method static \ItemProperty findOneByDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) findOneByDatetimeValue(string $datetime_value) find object in database by datetime_value
 * @method static \ItemProperty retrieveByDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) retrieveByDatetimeValue(string $datetime_value) retrieve object from poll by datetime_value, get it from db if not exist in poll

 * @method void setOrdering(integer $ordering) set ordering value
 * @method integer getOrdering() get ordering value
 * @method static \ItemProperty[] findByOrdering(integer $ordering) find objects in database by ordering
 * @method static \ItemProperty findOneByOrdering(integer $ordering) find object in database by ordering
 * @method static \ItemProperty retrieveByOrdering(integer $ordering) retrieve object from poll by ordering, get it from db if not exist in poll


 */
abstract class ItemPropertyBase extends ActiveRecord {
    protected static $_tableName = 'item_property';
    protected static $_phpName = 'ItemProperty';
    protected static $_pk = 'id';
    protected static $_alias = 'i';
    protected static $_dbConnectName = 'item_property';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'item_id' => array('name' => 'item_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'property' => array('name' => 'property',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'text_value' => array('name' => 'text_value',
                'type' => 'string',
                'db_type' => 'text'),
        'int_value' => array('name' => 'int_value',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'float_value' => array('name' => 'float_value',
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(20,2)',
                'length' => 20),
        'boolean_value' => array('name' => 'boolean_value',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'datetime_value' => array('name' => 'datetime_value',
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'ordering' => array('name' => 'ordering',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
     );
    protected static $_validate = array(
    );
    protected static $_cols = array('id','item_id','property','text_value','int_value','float_value','boolean_value','datetime_value','ordering');

    public function setTableDefinition() {
    }

    /**
     * save object model
     * @return boolean
     * @throws \Exception
     */
    public function save() {
        $conn = Manager::getConnection(self::getDbConnectName());
        $conn->beginTransaction();
        try {
            $this->_beforeSave();
            $status = $this->saveToDb();
            $this->_afterSave();
            $conn->commit();
            self::addInstanceToPool($this, $this->getPkValue());
            return $status;
        }
        catch (\Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }

    /**
     * delete object model
     * @return boolean
     * @throws \Exception
     */
    public function delete() {
        $conn = Manager::getConnection(self::getDbConnectName());
        try {
            $this->_beforeDelete();
            $this->deleteFromDb();
            $this->_afterDelete();
            $conn->commit();
            self::removeInstanceFromPool($this->getPkValue());
            return true;
        }
        catch (\Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }
}