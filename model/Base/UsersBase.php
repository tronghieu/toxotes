<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Users
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $username username type : varchar(50) max_length : 50
 * @property string $email email type : varchar(100) max_length : 100
 * @property string $section section type : enum('STAFF','MEMBER','GUESS') max_length : 6
 * @property string $status status type : enum('ACTIVE','INACTIVE','DELETED') max_length : 8
 * @property integer $banned banned type : tinyint(1)
 * @property integer $active_email active_email type : tinyint(1)
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $gender gender type : enum('MALE','FEMALE','OTHER') max_length : 6
 * @property string $phone_number phone_number type : varchar(100) max_length : 100
 * @property date $birthday birthday type : date
 * @property string $secret secret type : char(32) max_length : 32
 * @property string $password password type : char(72) max_length : 72
 * @property string $last_login_ip last_login_ip type : varchar(20) max_length : 20
 * @property datetime $last_visit_time last_visit_time type : datetime
 * @property datetime $register_time register_time type : datetime
 * @property datetime $modified_time modified_time type : datetime

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

 * @method void setEmail(string $email) set email value
 * @method string getEmail() get email value
 * @method static \Users[] findByEmail(string $email) find objects in database by email
 * @method static \Users findOneByEmail(string $email) find object in database by email
 * @method static \Users retrieveByEmail(string $email) retrieve object from poll by email, get it from db if not exist in poll

 * @method void setSection(string $section) set section value
 * @method string getSection() get section value
 * @method static \Users[] findBySection(string $section) find objects in database by section
 * @method static \Users findOneBySection(string $section) find object in database by section
 * @method static \Users retrieveBySection(string $section) retrieve object from poll by section, get it from db if not exist in poll

 * @method void setStatus(string $status) set status value
 * @method string getStatus() get status value
 * @method static \Users[] findByStatus(string $status) find objects in database by status
 * @method static \Users findOneByStatus(string $status) find object in database by status
 * @method static \Users retrieveByStatus(string $status) retrieve object from poll by status, get it from db if not exist in poll

 * @method void setBanned(integer $banned) set banned value
 * @method integer getBanned() get banned value
 * @method static \Users[] findByBanned(integer $banned) find objects in database by banned
 * @method static \Users findOneByBanned(integer $banned) find object in database by banned
 * @method static \Users retrieveByBanned(integer $banned) retrieve object from poll by banned, get it from db if not exist in poll

 * @method void setActiveEmail(integer $active_email) set active_email value
 * @method integer getActiveEmail() get active_email value
 * @method static \Users[] findByActiveEmail(integer $active_email) find objects in database by active_email
 * @method static \Users findOneByActiveEmail(integer $active_email) find object in database by active_email
 * @method static \Users retrieveByActiveEmail(integer $active_email) retrieve object from poll by active_email, get it from db if not exist in poll

 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \Users[] findByName(string $name) find objects in database by name
 * @method static \Users findOneByName(string $name) find object in database by name
 * @method static \Users retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll

 * @method void setGender(string $gender) set gender value
 * @method string getGender() get gender value
 * @method static \Users[] findByGender(string $gender) find objects in database by gender
 * @method static \Users findOneByGender(string $gender) find object in database by gender
 * @method static \Users retrieveByGender(string $gender) retrieve object from poll by gender, get it from db if not exist in poll

 * @method void setPhoneNumber(string $phone_number) set phone_number value
 * @method string getPhoneNumber() get phone_number value
 * @method static \Users[] findByPhoneNumber(string $phone_number) find objects in database by phone_number
 * @method static \Users findOneByPhoneNumber(string $phone_number) find object in database by phone_number
 * @method static \Users retrieveByPhoneNumber(string $phone_number) retrieve object from poll by phone_number, get it from db if not exist in poll

 * @method void setBirthday(\Flywheel\Db\Type\DateTime $birthday) setBirthday(string $birthday) set birthday value
 * @method \Flywheel\Db\Type\DateTime getBirthday() get birthday value
 * @method static \Users[] findByBirthday(\Flywheel\Db\Type\DateTime $birthday) findByBirthday(string $birthday) find objects in database by birthday
 * @method static \Users findOneByBirthday(\Flywheel\Db\Type\DateTime $birthday) findOneByBirthday(string $birthday) find object in database by birthday
 * @method static \Users retrieveByBirthday(\Flywheel\Db\Type\DateTime $birthday) retrieveByBirthday(string $birthday) retrieve object from poll by birthday, get it from db if not exist in poll

 * @method void setSecret(string $secret) set secret value
 * @method string getSecret() get secret value
 * @method static \Users[] findBySecret(string $secret) find objects in database by secret
 * @method static \Users findOneBySecret(string $secret) find object in database by secret
 * @method static \Users retrieveBySecret(string $secret) retrieve object from poll by secret, get it from db if not exist in poll

 * @method void setPassword(string $password) set password value
 * @method string getPassword() get password value
 * @method static \Users[] findByPassword(string $password) find objects in database by password
 * @method static \Users findOneByPassword(string $password) find object in database by password
 * @method static \Users retrieveByPassword(string $password) retrieve object from poll by password, get it from db if not exist in poll

 * @method void setLastLoginIp(string $last_login_ip) set last_login_ip value
 * @method string getLastLoginIp() get last_login_ip value
 * @method static \Users[] findByLastLoginIp(string $last_login_ip) find objects in database by last_login_ip
 * @method static \Users findOneByLastLoginIp(string $last_login_ip) find object in database by last_login_ip
 * @method static \Users retrieveByLastLoginIp(string $last_login_ip) retrieve object from poll by last_login_ip, get it from db if not exist in poll

 * @method void setLastVisitTime(\Flywheel\Db\Type\DateTime $last_visit_time) setLastVisitTime(string $last_visit_time) set last_visit_time value
 * @method \Flywheel\Db\Type\DateTime getLastVisitTime() get last_visit_time value
 * @method static \Users[] findByLastVisitTime(\Flywheel\Db\Type\DateTime $last_visit_time) findByLastVisitTime(string $last_visit_time) find objects in database by last_visit_time
 * @method static \Users findOneByLastVisitTime(\Flywheel\Db\Type\DateTime $last_visit_time) findOneByLastVisitTime(string $last_visit_time) find object in database by last_visit_time
 * @method static \Users retrieveByLastVisitTime(\Flywheel\Db\Type\DateTime $last_visit_time) retrieveByLastVisitTime(string $last_visit_time) retrieve object from poll by last_visit_time, get it from db if not exist in poll

 * @method void setRegisterTime(\Flywheel\Db\Type\DateTime $register_time) setRegisterTime(string $register_time) set register_time value
 * @method \Flywheel\Db\Type\DateTime getRegisterTime() get register_time value
 * @method static \Users[] findByRegisterTime(\Flywheel\Db\Type\DateTime $register_time) findByRegisterTime(string $register_time) find objects in database by register_time
 * @method static \Users findOneByRegisterTime(\Flywheel\Db\Type\DateTime $register_time) findOneByRegisterTime(string $register_time) find object in database by register_time
 * @method static \Users retrieveByRegisterTime(\Flywheel\Db\Type\DateTime $register_time) retrieveByRegisterTime(string $register_time) retrieve object from poll by register_time, get it from db if not exist in poll

 * @method void setModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) setModifiedTime(string $modified_time) set modified_time value
 * @method \Flywheel\Db\Type\DateTime getModifiedTime() get modified_time value
 * @method static \Users[] findByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \Users findOneByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findOneByModifiedTime(string $modified_time) find object in database by modified_time
 * @method static \Users retrieveByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) retrieveByModifiedTime(string $modified_time) retrieve object from poll by modified_time, get it from db if not exist in poll


 */
abstract class UsersBase extends ActiveRecord {
    protected static $_tableName = 'users';
    protected static $_phpName = 'Users';
    protected static $_pk = 'id';
    protected static $_alias = 'u';
    protected static $_dbConnectName = 'users';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'username' => array('name' => 'username',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(50)',
                'length' => 50),
        'email' => array('name' => 'email',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'section' => array('name' => 'section',
                'default' => 'MEMBER',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'STAFF\',\'MEMBER\',\'GUESS\')',
                'length' => 6),
        'status' => array('name' => 'status',
                'default' => 'INACTIVE',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'ACTIVE\',\'INACTIVE\',\'DELETED\')',
                'length' => 8),
        'banned' => array('name' => 'banned',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'active_email' => array('name' => 'active_email',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'name' => array('name' => 'name',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'gender' => array('name' => 'gender',
                'default' => 'MALE',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'MALE\',\'FEMALE\',\'OTHER\')',
                'length' => 6),
        'phone_number' => array('name' => 'phone_number',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'birthday' => array('name' => 'birthday',
                'default' => '0000-00-00',
                'not_null' => true,
                'type' => 'date',
                'db_type' => 'date'),
        'secret' => array('name' => 'secret',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'char(32)',
                'length' => 32),
        'password' => array('name' => 'password',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'char(72)',
                'length' => 72),
        'last_login_ip' => array('name' => 'last_login_ip',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(20)',
                'length' => 20),
        'last_visit_time' => array('name' => 'last_visit_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'register_time' => array('name' => 'register_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'modified_time' => array('name' => 'modified_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
     );
    protected static $_validate = array(
        'username' => array(
            array('name' => 'Unique',
                'message'=> 'username\'s was used'
            ),
        ),
        'email' => array(
            array('name' => 'Unique',
                'message'=> 'email\'s was used'
            ),
        ),
        'section' => array(
            array('name' => 'ValidValues',
                'value' => 'STAFF|MEMBER|GUESS',
                'message'=> 'section\'s values is not allowed'
            ),
        ),
        'status' => array(
            array('name' => 'ValidValues',
                'value' => 'ACTIVE|INACTIVE|DELETED',
                'message'=> 'status\'s values is not allowed'
            ),
        ),
        'gender' => array(
            array('name' => 'ValidValues',
                'value' => 'MALE|FEMALE|OTHER',
                'message'=> 'gender\'s values is not allowed'
            ),
        ),
    );
    protected static $_validatorRules = array(
        'username' => array(
            array('name' => 'Unique',
                'message'=> 'username\'s was used'
            ),
        ),
        'email' => array(
            array('name' => 'Unique',
                'message'=> 'email\'s was used'
            ),
        ),
        'section' => array(
            array('name' => 'ValidValues',
                'value' => 'STAFF|MEMBER|GUESS',
                'message'=> 'section\'s values is not allowed'
            ),
        ),
        'status' => array(
            array('name' => 'ValidValues',
                'value' => 'ACTIVE|INACTIVE|DELETED',
                'message'=> 'status\'s values is not allowed'
            ),
        ),
        'gender' => array(
            array('name' => 'ValidValues',
                'value' => 'MALE|FEMALE|OTHER',
                'message'=> 'gender\'s values is not allowed'
            ),
        ),
    );
    protected static $_init = false;
    protected static $_cols = array('id','username','email','section','status','banned','active_email','name','gender','phone_number','birthday','secret','password','last_login_ip','last_visit_time','register_time','modified_time');

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