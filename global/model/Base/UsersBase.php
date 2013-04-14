<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Users
 *  This class has been auto-generated at 03/04/2013 14:50:59
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $email email type : varchar(50) max_length : 50
 * @property string $password password type : char(56) max_length : 56
 * @property string $full_name full_name type : varchar(255) max_length : 255
 * @property string $phone phone type : varchar(20) max_length : 20
 * @property integer $status status type : tinyint(1)
 * @property integer $banned banned type : tinyint(1)
 * @property string $secret secret type : char(32) max_length : 32
 * @property string $last_login_time last_login_time type : datetime max_length : 
 * @property string $last_login_ip last_login_ip type : varchar(20) max_length : 20
 * @property string $created_time created_time type : datetime max_length : 
 * @property string $modified_time modified_time type : datetime max_length : 

 * @method static \Users[] findById(integer $id) find objects in database by id
 * @method static \Users findOneById(integer $id) find object in database by id
 * @method static \Users[] findByEmail(string $email) find objects in database by email
 * @method static \Users findOneByEmail(string $email) find object in database by email
 * @method static \Users[] findByPassword(string $password) find objects in database by password
 * @method static \Users findOneByPassword(string $password) find object in database by password
 * @method static \Users[] findByFullName(string $full_name) find objects in database by full_name
 * @method static \Users findOneByFullName(string $full_name) find object in database by full_name
 * @method static \Users[] findByPhone(string $phone) find objects in database by phone
 * @method static \Users findOneByPhone(string $phone) find object in database by phone
 * @method static \Users[] findByStatus(integer $status) find objects in database by status
 * @method static \Users findOneByStatus(integer $status) find object in database by status
 * @method static \Users[] findByBanned(integer $banned) find objects in database by banned
 * @method static \Users findOneByBanned(integer $banned) find object in database by banned
 * @method static \Users[] findBySecret(string $secret) find objects in database by secret
 * @method static \Users findOneBySecret(string $secret) find object in database by secret
 * @method static \Users[] findByLastLoginTime(string $last_login_time) find objects in database by last_login_time
 * @method static \Users findOneByLastLoginTime(string $last_login_time) find object in database by last_login_time
 * @method static \Users[] findByLastLoginIp(string $last_login_ip) find objects in database by last_login_ip
 * @method static \Users findOneByLastLoginIp(string $last_login_ip) find object in database by last_login_ip
 * @method static \Users[] findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \Users findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \Users[] findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \Users findOneByModifiedTime(string $modified_time) find object in database by modified_time

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
        'email' => array('name' => 'email',
                'type' => 'string',
                'db_type' => 'varchar(50)',
                'length' => 50),
        'password' => array('name' => 'password',
                'type' => 'string',
                'db_type' => 'char(56)',
                'length' => 56),
        'full_name' => array('name' => 'full_name',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'phone' => array('name' => 'phone',
                'type' => 'string',
                'db_type' => 'varchar(20)',
                'length' => 20),
        'status' => array('name' => 'status',
                'default' => 1,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'banned' => array('name' => 'banned',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'secret' => array('name' => 'secret',
                'type' => 'string',
                'db_type' => 'char(32)',
                'length' => 32),
        'last_login_time' => array('name' => 'last_login_time',
                'type' => 'string',
                'db_type' => 'datetime'),
        'last_login_ip' => array('name' => 'last_login_ip',
                'type' => 'string',
                'db_type' => 'varchar(20)',
                'length' => 20),
        'created_time' => array('name' => 'created_time',
                'type' => 'string',
                'db_type' => 'datetime'),
        'modified_time' => array('name' => 'modified_time',
                'type' => 'string',
                'db_type' => 'datetime'),
);
    protected static $_validate = array(
        'email' => array('require' => '"email" is required!'),
        'password' => array('require' => '"password" is required!'),
        'status' => array('require' => '"status" is required!'),
        'banned' => array('require' => '"banned" is required!'),
        'secret' => array('require' => '"secret" is required!'),
        'created_time' => array('require' => '"created_time" is required!'),
        'modified_time' => array('require' => '"modified_time" is required!'),
);
    protected static $_cols = array('id','email','password','full_name','phone','status','banned','secret','last_login_time','last_login_ip','created_time','modified_time');

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