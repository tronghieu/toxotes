<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * WidgetBlock
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $position position type : varchar(255) max_length : 255
 * @property string $path path type : varchar(255) max_length : 255
 * @property string $status status type : enum('ACTIVE','INACTIVE') max_length : 8
 * @property string $language language type : varchar(10) max_length : 10
 * @property string $note note type : text max_length : 
 * @property string $properties properties type : text max_length : 
 * @property integer $ordering ordering type : int(11)
 * @property datetime $created_time created_time type : datetime
 * @property datetime $modified_time modified_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \WidgetBlock[] findById(integer $id) find objects in database by id
 * @method static \WidgetBlock findOneById(integer $id) find object in database by id
 * @method static \WidgetBlock retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \WidgetBlock[] findByName(string $name) find objects in database by name
 * @method static \WidgetBlock findOneByName(string $name) find object in database by name
 * @method static \WidgetBlock retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll

 * @method void setPosition(string $position) set position value
 * @method string getPosition() get position value
 * @method static \WidgetBlock[] findByPosition(string $position) find objects in database by position
 * @method static \WidgetBlock findOneByPosition(string $position) find object in database by position
 * @method static \WidgetBlock retrieveByPosition(string $position) retrieve object from poll by position, get it from db if not exist in poll

 * @method void setPath(string $path) set path value
 * @method string getPath() get path value
 * @method static \WidgetBlock[] findByPath(string $path) find objects in database by path
 * @method static \WidgetBlock findOneByPath(string $path) find object in database by path
 * @method static \WidgetBlock retrieveByPath(string $path) retrieve object from poll by path, get it from db if not exist in poll

 * @method void setStatus(string $status) set status value
 * @method string getStatus() get status value
 * @method static \WidgetBlock[] findByStatus(string $status) find objects in database by status
 * @method static \WidgetBlock findOneByStatus(string $status) find object in database by status
 * @method static \WidgetBlock retrieveByStatus(string $status) retrieve object from poll by status, get it from db if not exist in poll

 * @method void setLanguage(string $language) set language value
 * @method string getLanguage() get language value
 * @method static \WidgetBlock[] findByLanguage(string $language) find objects in database by language
 * @method static \WidgetBlock findOneByLanguage(string $language) find object in database by language
 * @method static \WidgetBlock retrieveByLanguage(string $language) retrieve object from poll by language, get it from db if not exist in poll

 * @method void setNote(string $note) set note value
 * @method string getNote() get note value
 * @method static \WidgetBlock[] findByNote(string $note) find objects in database by note
 * @method static \WidgetBlock findOneByNote(string $note) find object in database by note
 * @method static \WidgetBlock retrieveByNote(string $note) retrieve object from poll by note, get it from db if not exist in poll

 * @method void setProperties(string $properties) set properties value
 * @method string getProperties() get properties value
 * @method static \WidgetBlock[] findByProperties(string $properties) find objects in database by properties
 * @method static \WidgetBlock findOneByProperties(string $properties) find object in database by properties
 * @method static \WidgetBlock retrieveByProperties(string $properties) retrieve object from poll by properties, get it from db if not exist in poll

 * @method void setOrdering(integer $ordering) set ordering value
 * @method integer getOrdering() get ordering value
 * @method static \WidgetBlock[] findByOrdering(integer $ordering) find objects in database by ordering
 * @method static \WidgetBlock findOneByOrdering(integer $ordering) find object in database by ordering
 * @method static \WidgetBlock retrieveByOrdering(integer $ordering) retrieve object from poll by ordering, get it from db if not exist in poll

 * @method void setCreatedTime(\Flywheel\Db\Type\DateTime $created_time) setCreatedTime(string $created_time) set created_time value
 * @method \Flywheel\Db\Type\DateTime getCreatedTime() get created_time value
 * @method static \WidgetBlock[] findByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \WidgetBlock findOneByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \WidgetBlock retrieveByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) retrieveByCreatedTime(string $created_time) retrieve object from poll by created_time, get it from db if not exist in poll

 * @method void setModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) setModifiedTime(string $modified_time) set modified_time value
 * @method \Flywheel\Db\Type\DateTime getModifiedTime() get modified_time value
 * @method static \WidgetBlock[] findByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \WidgetBlock findOneByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findOneByModifiedTime(string $modified_time) find object in database by modified_time
 * @method static \WidgetBlock retrieveByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) retrieveByModifiedTime(string $modified_time) retrieve object from poll by modified_time, get it from db if not exist in poll


 */
abstract class WidgetBlockBase extends ActiveRecord {
    protected static $_tableName = 'widget_block';
    protected static $_phpName = 'WidgetBlock';
    protected static $_pk = 'id';
    protected static $_alias = 'w';
    protected static $_dbConnectName = 'widget_block';
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
        'language' => array('name' => 'language',
                'default' => '*',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(10)',
                'length' => 10),
        'note' => array('name' => 'note',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'text'),
        'properties' => array('name' => 'properties',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'ordering' => array('name' => 'ordering',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
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
    protected static $_validatorRules = array(
        'status' => array(
            array('name' => 'ValidValues',
                'value' => 'ACTIVE|INACTIVE',
                'message'=> 'status\'s values is not allowed'
            ),
        ),
    );
    protected static $_init = false;
    protected static $_cols = array('id','name','position','path','status','language','note','properties','ordering','created_time','modified_time');

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