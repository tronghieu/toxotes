<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * UsersProfiles
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11)
 * @property integer $user_id user_id type : int(11) unsigned
 * @property string $profile_key profile_key type : varchar(255) max_length : 255
 * @property string $profile_value profile_value type : varchar(255) max_length : 255
 * @property integer $ordering ordering type : int(11)

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \UsersProfiles[] findById(integer $id) find objects in database by id
 * @method static \UsersProfiles findOneById(integer $id) find object in database by id
 * @method static \UsersProfiles retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setUserId(integer $user_id) set user_id value
 * @method integer getUserId() get user_id value
 * @method static \UsersProfiles[] findByUserId(integer $user_id) find objects in database by user_id
 * @method static \UsersProfiles findOneByUserId(integer $user_id) find object in database by user_id
 * @method static \UsersProfiles retrieveByUserId(integer $user_id) retrieve object from poll by user_id, get it from db if not exist in poll

 * @method void setProfileKey(string $profile_key) set profile_key value
 * @method string getProfileKey() get profile_key value
 * @method static \UsersProfiles[] findByProfileKey(string $profile_key) find objects in database by profile_key
 * @method static \UsersProfiles findOneByProfileKey(string $profile_key) find object in database by profile_key
 * @method static \UsersProfiles retrieveByProfileKey(string $profile_key) retrieve object from poll by profile_key, get it from db if not exist in poll

 * @method void setProfileValue(string $profile_value) set profile_value value
 * @method string getProfileValue() get profile_value value
 * @method static \UsersProfiles[] findByProfileValue(string $profile_value) find objects in database by profile_value
 * @method static \UsersProfiles findOneByProfileValue(string $profile_value) find object in database by profile_value
 * @method static \UsersProfiles retrieveByProfileValue(string $profile_value) retrieve object from poll by profile_value, get it from db if not exist in poll

 * @method void setOrdering(integer $ordering) set ordering value
 * @method integer getOrdering() get ordering value
 * @method static \UsersProfiles[] findByOrdering(integer $ordering) find objects in database by ordering
 * @method static \UsersProfiles findOneByOrdering(integer $ordering) find object in database by ordering
 * @method static \UsersProfiles retrieveByOrdering(integer $ordering) retrieve object from poll by ordering, get it from db if not exist in poll


 */
abstract class UsersProfilesBase extends ActiveRecord {
    protected static $_tableName = 'users_profiles';
    protected static $_phpName = 'UsersProfiles';
    protected static $_pk = 'id';
    protected static $_alias = 'u';
    protected static $_dbConnectName = 'users_profiles';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11)',
                'length' => 4),
        'user_id' => array('name' => 'user_id',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'profile_key' => array('name' => 'profile_key',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'profile_value' => array('name' => 'profile_value',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'ordering' => array('name' => 'ordering',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
     );
    protected static $_validate = array(
    );
    protected static $_validatorRules = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','user_id','profile_key','profile_value','ordering');

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