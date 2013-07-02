<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * SystemFields
 *  This class has been auto-generated at 02/07/2013 15:29:10
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $key key type : varchar(255) max_length : 255
 * @property string $title title type : varchar(255) max_length : 255
 * @property string $value value type : text max_length : 
 * @property string $type type type : varchar(100) max_length : 100

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \SystemFields[] findById(integer $id) find objects in database by id
 * @method static \SystemFields findOneById(integer $id) find object in database by id
 * @method static \SystemFields retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setKey(string $key) set key value
 * @method string getKey() get key value
 * @method static \SystemFields[] findByKey(string $key) find objects in database by key
 * @method static \SystemFields findOneByKey(string $key) find object in database by key
 * @method static \SystemFields retrieveByKey(string $key) retrieve object from poll by key, get it from db if not exist in poll

 * @method void setTitle(string $title) set title value
 * @method string getTitle() get title value
 * @method static \SystemFields[] findByTitle(string $title) find objects in database by title
 * @method static \SystemFields findOneByTitle(string $title) find object in database by title
 * @method static \SystemFields retrieveByTitle(string $title) retrieve object from poll by title, get it from db if not exist in poll

 * @method void setValue(string $value) set value value
 * @method string getValue() get value value
 * @method static \SystemFields[] findByValue(string $value) find objects in database by value
 * @method static \SystemFields findOneByValue(string $value) find object in database by value
 * @method static \SystemFields retrieveByValue(string $value) retrieve object from poll by value, get it from db if not exist in poll

 * @method void setType(string $type) set type value
 * @method string getType() get type value
 * @method static \SystemFields[] findByType(string $type) find objects in database by type
 * @method static \SystemFields findOneByType(string $type) find object in database by type
 * @method static \SystemFields retrieveByType(string $type) retrieve object from poll by type, get it from db if not exist in poll


 */
abstract class SystemFieldsBase extends ActiveRecord {
    protected static $_tableName = 'system_fields';
    protected static $_phpName = 'SystemFields';
    protected static $_pk = 'id';
    protected static $_alias = 's';
    protected static $_dbConnectName = 'system_fields';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'key' => array('name' => 'key',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'title' => array('name' => 'title',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'value' => array('name' => 'value',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'type' => array('name' => 'type',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
     );
    protected static $_validate = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','key','title','value','type');

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