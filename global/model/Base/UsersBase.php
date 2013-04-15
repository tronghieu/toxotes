<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Users
 *  This class has been auto-generated at 15/04/2013 11:00:35
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $username username type : varchar(50) max_length : 50
 * @property string $password password type : char(64) max_length : 64
 * @property string $email email type : varchar(100) max_length : 100
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $phone_number phone_number type : varchar(100) max_length : 100
 * @property integer $status status type : tinyint(4)
 * @property integer $active_email active_email type : tinyint(4)
 * @property string $birthday birthday type : date max_length : 
 * @property string $secret secret type : char(32) max_length : 32
 * @property string $register_time register_time type : datetime max_length : 
 * @property string $last_visit_time last_visit_time type : datetime max_length : 

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Users[] findById(integer $id) find objects in database by id
 * @method static \Users findOneById(integer $id) find object in database by id
 * @method static \Users retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll
 * @method void setUsername(string $username) set username value
 * @method string getUsername() get username value
 * @method static \Users[] findByUsername(string $username) find objects in database by username
 * @method static \Users findOneByUsername(string $username) find object in database by username
 * @method static \Users retrieveByUsername(string $username) retrieve object from poll by username, get it from db if not exist in poll
 * @method void setPassword(string $password) set password value
 * @method string getPassword() get password value
 * @method static \Users[] findByPassword(string $password) find objects in database by password
 * @method static \Users findOneByPassword(string $password) find object in database by password
 * @method static \Users retrieveByPassword(string $password) retrieve object from poll by password, get it from db if not exist in poll
 * @method void setEmail(string $email) set email value
 * @method string getEmail() get email value
 * @method static \Users[] findByEmail(string $email) find objects in database by email
 * @method static \Users findOneByEmail(string $email) find object in database by email
 * @method static \Users retrieveByEmail(string $email) retrieve object from poll by email, get it from db if not exist in poll
 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \Users[] findByName(string $name) find objects in database by name
 * @method static \Users findOneByName(string $name) find object in database by name
 * @method static \Users retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll
 * @method void setPhoneNumber(string $phone_number) set phone_number value
 * @method string getPhoneNumber() get phone_number value
 * @method static \Users[] findByPhoneNumber(string $phone_number) find objects in database by phone_number
 * @method static \Users findOneByPhoneNumber(string $phone_number) find object in database by phone_number
 * @method static \Users retrieveByPhoneNumber(string $phone_number) retrieve object from poll by phone_number, get it from db if not exist in poll
 * @method void setStatus(integer $status) set status value
 * @method integer getStatus() get status value
 * @method static \Users[] findByStatus(integer $status) find objects in database by status
 * @method static \Users findOneByStatus(integer $status) find object in database by status
 * @method static \Users retrieveByStatus(integer $status) retrieve object from poll by status, get it from db if not exist in poll
 * @method void setActiveEmail(integer $active_email) set active_email value
 * @method integer getActiveEmail() get active_email value
 * @method static \Users[] findByActiveEmail(integer $active_email) find objects in database by active_email
 * @method static \Users findOneByActiveEmail(integer $active_email) find object in database by active_email
 * @method static \Users retrieveByActiveEmail(integer $active_email) retrieve object from poll by active_email, get it from db if not exist in poll
 * @method void setBirthday(string $birthday) set birthday value
 * @method string getBirthday() get birthday value
 * @method static \Users[] findByBirthday(string $birthday) find objects in database by birthday
 * @method static \Users findOneByBirthday(string $birthday) find object in database by birthday
 * @method static \Users retrieveByBirthday(string $birthday) retrieve object from poll by birthday, get it from db if not exist in poll
 * @method void setSecret(string $secret) set secret value
 * @method string getSecret() get secret value
 * @method static \Users[] findBySecret(string $secret) find objects in database by secret
 * @method static \Users findOneBySecret(string $secret) find object in database by secret
 * @method static \Users retrieveBySecret(string $secret) retrieve object from poll by secret, get it from db if not exist in poll
 * @method void setRegisterTime(string $register_time) set register_time value
 * @method string getRegisterTime() get register_time value
 * @method static \Users[] findByRegisterTime(string $register_time) find objects in database by register_time
 * @method static \Users findOneByRegisterTime(string $register_time) find object in database by register_time
 * @method static \Users retrieveByRegisterTime(string $register_time) retrieve object from poll by register_time, get it from db if not exist in poll
 * @method void setLastVisitTime(string $last_visit_time) set last_visit_time value
 * @method string getLastVisitTime() get last_visit_time value
 * @method static \Users[] findByLastVisitTime(string $last_visit_time) find objects in database by last_visit_time
 * @method static \Users findOneByLastVisitTime(string $last_visit_time) find object in database by last_visit_time
 * @method static \Users retrieveByLastVisitTime(string $last_visit_time) retrieve object from poll by last_visit_time, get it from db if not exist in poll

 */
abstract class UsersBase extends ActiveRecord {
    protected static $_tableName = 'users';
    protected static $_pk = 'id';
    protected static $_alias = 'u';
    protected static $_dbConnectName = 'users';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'username' => array('name' => 'username',
                'type' => 'string',
                'db_type' => 'varchar(50)',
                'length' => 50),
        'password' => array('name' => 'password',
                'type' => 'string',
                'db_type' => 'char(64)',
                'length' => 64),
        'email' => array('name' => 'email',
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'name' => array('name' => 'name',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'phone_number' => array('name' => 'phone_number',
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'status' => array('name' => 'status',
                'default' => 1,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(4)',
                'length' => 1),
        'active_email' => array('name' => 'active_email',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(4)',
                'length' => 1),
        'birthday' => array('name' => 'birthday',
                'default' => '0000-00-00',
                'type' => 'string',
                'db_type' => 'date'),
        'secret' => array('name' => 'secret',
                'type' => 'string',
                'db_type' => 'char(32)',
                'length' => 32),
        'register_time' => array('name' => 'register_time',
                'default' => '0000-00-00 00:00:00',
                'type' => 'string',
                'db_type' => 'datetime'),
        'last_visit_time' => array('name' => 'last_visit_time',
                'default' => '0000-00-00 00:00:00',
                'type' => 'string',
                'db_type' => 'datetime'),
);
    protected static $_validate = array(
        'username' => array('require' => '"username" is required!',
                'unique' => 'username\'s values has already been taken'),
        'password' => array('require' => '"password" is required!'),
        'email' => array('require' => '"email" is required!'),
        'name' => array('require' => '"name" is required!'),
        'phone_number' => array('require' => '"phone_number" is required!'),
        'status' => array('require' => '"status" is required!'),
        'active_email' => array('require' => '"active_email" is required!'),
        'birthday' => array('require' => '"birthday" is required!'),
        'secret' => array('require' => '"secret" is required!'),
        'register_time' => array('require' => '"register_time" is required!'),
        'last_visit_time' => array('require' => '"last_visit_time" is required!'),
);
    protected static $_cols = array('id','username','password','email','name','phone_number','status','active_email','birthday','secret','register_time','last_visit_time');

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
            self::addInstanceToPool($this, $this->{$this->getPkValue()});
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
            self::removeInstanceFromPool($this->{$this->getPkValue()});
            return true;
        }
        catch (\Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }
}