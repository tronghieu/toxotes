<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Widget
 *  This class has been auto-generated at 28/06/2013 11:45:28
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $position position type : varchar(255) max_length : 255
 * @property string $path path type : varchar(255) max_length : 255
 * @property string $status status type : enum('ACTIVE','INACTIVE') max_length : 8
 * @property string $properties properties type : text max_length : 
 * @property datetime $created_time created_time type : datetime
 * @property datetime $modified_time modified_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Widget[] findById(integer $id) find objects in database by id
 * @method static \Widget findOneById(integer $id) find object in database by id
 * @method static \Widget retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \Widget[] findByName(string $name) find objects in database by name
 * @method static \Widget findOneByName(string $name) find object in database by name
 * @method static \Widget retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll

 * @method void setPosition(string $position) set position value
 * @method string getPosition() get position value
 * @method static \Widget[] findByPosition(string $position) find objects in database by position
 * @method static \Widget findOneByPosition(string $position) find object in database by position
 * @method static \Widget retrieveByPosition(string $position) retrieve object from poll by position, get it from db if not exist in poll

 * @method void setPath(string $path) set path value
 * @method string getPath() get path value
 * @method static \Widget[] findByPath(string $path) find objects in database by path
 * @method static \Widget findOneByPath(string $path) find object in database by path
 * @method static \Widget retrieveByPath(string $path) retrieve object from poll by path, get it from db if not exist in poll

 * @method void setStatus(string $status) set status value
 * @method string getStatus() get status value
 * @method static \Widget[] findByStatus(string $status) find objects in database by status
 * @method static \Widget findOneByStatus(string $status) find object in database by status
 * @method static \Widget retrieveByStatus(string $status) retrieve object from poll by status, get it from db if not exist in poll

 * @method void setProperties(string $properties) set properties value
 * @method string getProperties() get properties value
 * @method static \Widget[] findByProperties(string $properties) find objects in database by properties
 * @method static \Widget findOneByProperties(string $properties) find object in database by properties
 * @method static \Widget retrieveByProperties(string $properties) retrieve object from poll by properties, get it from db if not exist in poll

 * @method void setCreatedTime(\Flywheel\Db\Type\DateTime $created_time) setCreatedTime(string $created_time) set created_time value
 * @method \Flywheel\Db\Type\DateTime getCreatedTime() get created_time value
 * @method static \Widget[] findByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \Widget findOneByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \Widget retrieveByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) retrieveByCreatedTime(string $created_time) retrieve object from poll by created_time, get it from db if not exist in poll

 * @method void setModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) setModifiedTime(string $modified_time) set modified_time value
 * @method \Flywheel\Db\Type\DateTime getModifiedTime() get modified_time value
 * @method static \Widget[] findByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \Widget findOneByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findOneByModifiedTime(string $modified_time) find object in database by modified_time
 * @method static \Widget retrieveByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) retrieveByModifiedTime(string $modified_time) retrieve object from poll by modified_time, get it from db if not exist in poll


 */
abstract class WidgetBase extends ActiveRecord {
    protected static $_tableName = 'widget';
    protected static $_phpName = 'Widget';
    protected static $_pk = 'id';
    protected static $_alias = 'w';
    protected static $_dbConnectName = 'widget';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'name' => array('name' => 'name',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'position' => array('name' => 'position',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'path' => array('name' => 'path',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'status' => array('name' => 'status',
                'default' => 'ACTIVE',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'ACTIVE\',\'INACTIVE\')',
                'length' => 8),
        'properties' => array('name' => 'properties',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'created_time' => array('name' => 'created_time',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'modified_time' => array('name' => 'modified_time',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
     );
    protected static $_validate = array(
        'status' => array(
            array('name' => 'ValidValues',
                'value' => 'ACTIVE|INACTIVE',
                'message'=> 'status\'s values is not allowed'
            ),
        ),
    );
    protected static $_init = false;
    protected static $_cols = array('id','name','position','path','status','properties','created_time','modified_time');

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