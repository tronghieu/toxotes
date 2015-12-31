<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * ActivityLog
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $user_id user_id type : int(11) unsigned
 * @property string $activity activity type : varchar(255) max_length : 255
 * @property string $type type type : varchar(255) max_length : 255
 * @property string $description description type : text max_length : 
 * @property string $context context type : text max_length : 
 * @property datetime $action_time action_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \ActivityLog[] findById(integer $id) find objects in database by id
 * @method static \ActivityLog findOneById(integer $id) find object in database by id
 * @method static \ActivityLog retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setUserId(integer $user_id) set user_id value
 * @method integer getUserId() get user_id value
 * @method static \ActivityLog[] findByUserId(integer $user_id) find objects in database by user_id
 * @method static \ActivityLog findOneByUserId(integer $user_id) find object in database by user_id
 * @method static \ActivityLog retrieveByUserId(integer $user_id) retrieve object from poll by user_id, get it from db if not exist in poll

 * @method void setActivity(string $activity) set activity value
 * @method string getActivity() get activity value
 * @method static \ActivityLog[] findByActivity(string $activity) find objects in database by activity
 * @method static \ActivityLog findOneByActivity(string $activity) find object in database by activity
 * @method static \ActivityLog retrieveByActivity(string $activity) retrieve object from poll by activity, get it from db if not exist in poll

 * @method void setType(string $type) set type value
 * @method string getType() get type value
 * @method static \ActivityLog[] findByType(string $type) find objects in database by type
 * @method static \ActivityLog findOneByType(string $type) find object in database by type
 * @method static \ActivityLog retrieveByType(string $type) retrieve object from poll by type, get it from db if not exist in poll

 * @method void setDescription(string $description) set description value
 * @method string getDescription() get description value
 * @method static \ActivityLog[] findByDescription(string $description) find objects in database by description
 * @method static \ActivityLog findOneByDescription(string $description) find object in database by description
 * @method static \ActivityLog retrieveByDescription(string $description) retrieve object from poll by description, get it from db if not exist in poll

 * @method void setContext(string $context) set context value
 * @method string getContext() get context value
 * @method static \ActivityLog[] findByContext(string $context) find objects in database by context
 * @method static \ActivityLog findOneByContext(string $context) find object in database by context
 * @method static \ActivityLog retrieveByContext(string $context) retrieve object from poll by context, get it from db if not exist in poll

 * @method void setActionTime(\Flywheel\Db\Type\DateTime $action_time) setActionTime(string $action_time) set action_time value
 * @method \Flywheel\Db\Type\DateTime getActionTime() get action_time value
 * @method static \ActivityLog[] findByActionTime(\Flywheel\Db\Type\DateTime $action_time) findByActionTime(string $action_time) find objects in database by action_time
 * @method static \ActivityLog findOneByActionTime(\Flywheel\Db\Type\DateTime $action_time) findOneByActionTime(string $action_time) find object in database by action_time
 * @method static \ActivityLog retrieveByActionTime(\Flywheel\Db\Type\DateTime $action_time) retrieveByActionTime(string $action_time) retrieve object from poll by action_time, get it from db if not exist in poll


 */
abstract class ActivityLogBase extends ActiveRecord {
    protected static $_tableName = 'activity_log';
    protected static $_phpName = 'ActivityLog';
    protected static $_pk = 'id';
    protected static $_alias = 'a';
    protected static $_dbConnectName = 'activity_log';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'user_id' => array('name' => 'user_id',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'activity' => array('name' => 'activity',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'type' => array('name' => 'type',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'description' => array('name' => 'description',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'context' => array('name' => 'context',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'action_time' => array('name' => 'action_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
     );
    protected static $_validate = array(
    );
    protected static $_validatorRules = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','user_id','activity','type','description','context','action_time');

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