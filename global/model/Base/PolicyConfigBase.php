<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * PolicyConfig
 *  This class has been auto-generated at 03/04/2013 14:50:59
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $key key type : varchar(255) max_length : 255
 * @property number $number_value number_value type : decimal(20,2)
 * @property integer $boolean_value boolean_value type : tinyint(1)
 * @property string $string_value string_value type : text max_length : 
 * @property string $enum_value enum_value type : text max_length : 
 * @property string $type type type : enum('NUMBER','BOOLEAN','STRING','ENUM') max_length : 7
 * @property string $valid_time valid_time type : datetime max_length : 
 * @property string $invalid_time invalid_time type : datetime max_length : 
 * @property string $created_time created_time type : datetime max_length : 
 * @property string $modified_time modified_time type : timestamp max_length : 

 * @method static \PolicyConfig[] findById(integer $id) find objects in database by id
 * @method static \PolicyConfig findOneById(integer $id) find object in database by id
 * @method static \PolicyConfig[] findByKey(string $key) find objects in database by key
 * @method static \PolicyConfig findOneByKey(string $key) find object in database by key
 * @method static \PolicyConfig[] findByNumberValue(number $number_value) find objects in database by number_value
 * @method static \PolicyConfig findOneByNumberValue(number $number_value) find object in database by number_value
 * @method static \PolicyConfig[] findByBooleanValue(integer $boolean_value) find objects in database by boolean_value
 * @method static \PolicyConfig findOneByBooleanValue(integer $boolean_value) find object in database by boolean_value
 * @method static \PolicyConfig[] findByStringValue(string $string_value) find objects in database by string_value
 * @method static \PolicyConfig findOneByStringValue(string $string_value) find object in database by string_value
 * @method static \PolicyConfig[] findByEnumValue(string $enum_value) find objects in database by enum_value
 * @method static \PolicyConfig findOneByEnumValue(string $enum_value) find object in database by enum_value
 * @method static \PolicyConfig[] findByType(string $type) find objects in database by type
 * @method static \PolicyConfig findOneByType(string $type) find object in database by type
 * @method static \PolicyConfig[] findByValidTime(string $valid_time) find objects in database by valid_time
 * @method static \PolicyConfig findOneByValidTime(string $valid_time) find object in database by valid_time
 * @method static \PolicyConfig[] findByInvalidTime(string $invalid_time) find objects in database by invalid_time
 * @method static \PolicyConfig findOneByInvalidTime(string $invalid_time) find object in database by invalid_time
 * @method static \PolicyConfig[] findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \PolicyConfig findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \PolicyConfig[] findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \PolicyConfig findOneByModifiedTime(string $modified_time) find object in database by modified_time

 */
abstract class PolicyConfigBase extends ActiveRecord {
    protected static $_tableName = 'policy_config';
    protected static $_pk = 'id';
    protected static $_alias = 'p';
    protected static $_dbConnectName = 'policy_config';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'key' => array('name' => 'key',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'number_value' => array('name' => 'number_value',
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(20,2)',
                'length' => 20),
        'boolean_value' => array('name' => 'boolean_value',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'string_value' => array('name' => 'string_value',
                'type' => 'string',
                'db_type' => 'text'),
        'enum_value' => array('name' => 'enum_value',
                'type' => 'string',
                'db_type' => 'text'),
        'type' => array('name' => 'type',
                'type' => 'string',
                'db_type' => 'enum(\'NUMBER\',\'BOOLEAN\',\'STRING\',\'ENUM\')',
                'length' => 7),
        'valid_time' => array('name' => 'valid_time',
                'default' => '0000-00-00 00:00:00',
                'type' => 'string',
                'db_type' => 'datetime'),
        'invalid_time' => array('name' => 'invalid_time',
                'default' => '0000-00-00 00:00:00',
                'type' => 'string',
                'db_type' => 'datetime'),
        'created_time' => array('name' => 'created_time',
                'default' => '0000-00-00 00:00:00',
                'type' => 'string',
                'db_type' => 'datetime'),
        'modified_time' => array('name' => 'modified_time',
                'type' => 'string',
                'db_type' => 'timestamp'),
);
    protected static $_validate = array(
        'key' => array('require' => '"key" is required!'),
        'type' => array('filter' => array('allow' => array('NUMBER','BOOLEAN','STRING','ENUM'),
                            'message' => 'type\'s values is not allowed')),
        'valid_time' => array('require' => '"valid_time" is required!'),
        'invalid_time' => array('require' => '"invalid_time" is required!'),
        'created_time' => array('require' => '"created_time" is required!'),
);
    protected static $_cols = array('id','key','number_value','boolean_value','string_value','enum_value','type','valid_time','invalid_time','created_time','modified_time');

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
            return true;
        }
        catch (\Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }
}