<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * PostProperty
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $post_id post_id type : int(11)
 * @property string $property property type : varchar(255) max_length : 255
 * @property string $text_value text_value type : text max_length : 
 * @property integer $int_value int_value type : int(11)
 * @property number $float_value float_value type : decimal(20,2)
 * @property integer $boolean_value boolean_value type : tinyint(1)
 * @property datetime $datetime_value datetime_value type : datetime
 * @property string $value_type value_type type : enum('TEXT','INT','FLOAT','BOOLEAN','DATETIME') max_length : 8
 * @property integer $ordering ordering type : int(11)

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \PostProperty[] findById(integer $id) find objects in database by id
 * @method static \PostProperty findOneById(integer $id) find object in database by id
 * @method static \PostProperty retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setPostId(integer $post_id) set post_id value
 * @method integer getPostId() get post_id value
 * @method static \PostProperty[] findByPostId(integer $post_id) find objects in database by post_id
 * @method static \PostProperty findOneByPostId(integer $post_id) find object in database by post_id
 * @method static \PostProperty retrieveByPostId(integer $post_id) retrieve object from poll by post_id, get it from db if not exist in poll

 * @method void setProperty(string $property) set property value
 * @method string getProperty() get property value
 * @method static \PostProperty[] findByProperty(string $property) find objects in database by property
 * @method static \PostProperty findOneByProperty(string $property) find object in database by property
 * @method static \PostProperty retrieveByProperty(string $property) retrieve object from poll by property, get it from db if not exist in poll

 * @method void setTextValue(string $text_value) set text_value value
 * @method string getTextValue() get text_value value
 * @method static \PostProperty[] findByTextValue(string $text_value) find objects in database by text_value
 * @method static \PostProperty findOneByTextValue(string $text_value) find object in database by text_value
 * @method static \PostProperty retrieveByTextValue(string $text_value) retrieve object from poll by text_value, get it from db if not exist in poll

 * @method void setIntValue(integer $int_value) set int_value value
 * @method integer getIntValue() get int_value value
 * @method static \PostProperty[] findByIntValue(integer $int_value) find objects in database by int_value
 * @method static \PostProperty findOneByIntValue(integer $int_value) find object in database by int_value
 * @method static \PostProperty retrieveByIntValue(integer $int_value) retrieve object from poll by int_value, get it from db if not exist in poll

 * @method void setFloatValue(number $float_value) set float_value value
 * @method number getFloatValue() get float_value value
 * @method static \PostProperty[] findByFloatValue(number $float_value) find objects in database by float_value
 * @method static \PostProperty findOneByFloatValue(number $float_value) find object in database by float_value
 * @method static \PostProperty retrieveByFloatValue(number $float_value) retrieve object from poll by float_value, get it from db if not exist in poll

 * @method void setBooleanValue(integer $boolean_value) set boolean_value value
 * @method integer getBooleanValue() get boolean_value value
 * @method static \PostProperty[] findByBooleanValue(integer $boolean_value) find objects in database by boolean_value
 * @method static \PostProperty findOneByBooleanValue(integer $boolean_value) find object in database by boolean_value
 * @method static \PostProperty retrieveByBooleanValue(integer $boolean_value) retrieve object from poll by boolean_value, get it from db if not exist in poll

 * @method void setDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) setDatetimeValue(string $datetime_value) set datetime_value value
 * @method \Flywheel\Db\Type\DateTime getDatetimeValue() get datetime_value value
 * @method static \PostProperty[] findByDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) findByDatetimeValue(string $datetime_value) find objects in database by datetime_value
 * @method static \PostProperty findOneByDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) findOneByDatetimeValue(string $datetime_value) find object in database by datetime_value
 * @method static \PostProperty retrieveByDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) retrieveByDatetimeValue(string $datetime_value) retrieve object from poll by datetime_value, get it from db if not exist in poll

 * @method void setValueType(string $value_type) set value_type value
 * @method string getValueType() get value_type value
 * @method static \PostProperty[] findByValueType(string $value_type) find objects in database by value_type
 * @method static \PostProperty findOneByValueType(string $value_type) find object in database by value_type
 * @method static \PostProperty retrieveByValueType(string $value_type) retrieve object from poll by value_type, get it from db if not exist in poll

 * @method void setOrdering(integer $ordering) set ordering value
 * @method integer getOrdering() get ordering value
 * @method static \PostProperty[] findByOrdering(integer $ordering) find objects in database by ordering
 * @method static \PostProperty findOneByOrdering(integer $ordering) find object in database by ordering
 * @method static \PostProperty retrieveByOrdering(integer $ordering) retrieve object from poll by ordering, get it from db if not exist in poll


 */
abstract class PostPropertyBase extends ActiveRecord {
    protected static $_tableName = 'post_property';
    protected static $_phpName = 'PostProperty';
    protected static $_pk = 'id';
    protected static $_alias = 'p';
    protected static $_dbConnectName = 'post_property';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'post_id' => array('name' => 'post_id',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'property' => array('name' => 'property',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'text_value' => array('name' => 'text_value',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'text'),
        'int_value' => array('name' => 'int_value',
                'not_null' => false,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'float_value' => array('name' => 'float_value',
                'not_null' => false,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(20,2)',
                'length' => 20),
        'boolean_value' => array('name' => 'boolean_value',
                'not_null' => false,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'datetime_value' => array('name' => 'datetime_value',
                'not_null' => false,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'value_type' => array('name' => 'value_type',
                'default' => 'TEXT',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'TEXT\',\'INT\',\'FLOAT\',\'BOOLEAN\',\'DATETIME\')',
                'length' => 8),
        'ordering' => array('name' => 'ordering',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
     );
    protected static $_validate = array(
        'value_type' => array(
            array('name' => 'ValidValues',
                'value' => 'TEXT|INT|FLOAT|BOOLEAN|DATETIME',
                'message'=> 'value type\'s values is not allowed'
            ),
        ),
    );
    protected static $_validatorRules = array(
        'value_type' => array(
            array('name' => 'ValidValues',
                'value' => 'TEXT|INT|FLOAT|BOOLEAN|DATETIME',
                'message'=> 'value type\'s values is not allowed'
            ),
        ),
    );
    protected static $_init = false;
    protected static $_cols = array('id','post_id','property','text_value','int_value','float_value','boolean_value','datetime_value','value_type','ordering');

    public function setTableDefinition() {
    }

    /**
     * save object model
     * @return boolean
     * @throws \Exception
     */
    public function save($validate = true) {
        $conn = Manager::getConnection(self::getDbConnectName());
        $conn->beginTransaction();
        try {
            $this->_beforeSave();
            $status = $this->saveToDb($validate);
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
        $conn->beginTransaction();
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