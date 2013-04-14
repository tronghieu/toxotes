<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Account
 *  This class has been auto-generated at 03/04/2013 14:50:59
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $uk uk type : char(15) max_length : 15
 * @property string $name name type : varchar(255) max_length : 255
 * @property integer $version version type : int(11)
 * @property string $currency currency type : enum('VND','USD','CNY') max_length : 3
 * @property number $balance balance type : double(20,2)
 * @property number $frozen_balance frozen_balance type : double(20,2)
 * @property string $status status type : enum('NORMAL','FROZEN','DELETED') max_length : 7
 * @property string $type type type : enum('NORMAL','SYSTEM','FEE','PARTNER') max_length : 7
 * @property string $crc crc type : char(64) max_length : 64
 * @property string $created_time created_time type : datetime max_length : 
 * @property string $modified_time modified_time type : timestamp max_length : 

 * @method static \Account[] findById(integer $id) find objects in database by id
 * @method static \Account findOneById(integer $id) find object in database by id
 * @method static \Account[] findByUk(string $uk) find objects in database by uk
 * @method static \Account findOneByUk(string $uk) find object in database by uk
 * @method static \Account[] findByName(string $name) find objects in database by name
 * @method static \Account findOneByName(string $name) find object in database by name
 * @method static \Account[] findByVersion(integer $version) find objects in database by version
 * @method static \Account findOneByVersion(integer $version) find object in database by version
 * @method static \Account[] findByCurrency(string $currency) find objects in database by currency
 * @method static \Account findOneByCurrency(string $currency) find object in database by currency
 * @method static \Account[] findByBalance(number $balance) find objects in database by balance
 * @method static \Account findOneByBalance(number $balance) find object in database by balance
 * @method static \Account[] findByFrozenBalance(number $frozen_balance) find objects in database by frozen_balance
 * @method static \Account findOneByFrozenBalance(number $frozen_balance) find object in database by frozen_balance
 * @method static \Account[] findByStatus(string $status) find objects in database by status
 * @method static \Account findOneByStatus(string $status) find object in database by status
 * @method static \Account[] findByType(string $type) find objects in database by type
 * @method static \Account findOneByType(string $type) find object in database by type
 * @method static \Account[] findByCrc(string $crc) find objects in database by crc
 * @method static \Account findOneByCrc(string $crc) find object in database by crc
 * @method static \Account[] findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \Account findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \Account[] findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \Account findOneByModifiedTime(string $modified_time) find object in database by modified_time

 */
abstract class AccountBase extends ActiveRecord {
    protected static $_tableName = 'account';
    protected static $_pk = 'id';
    protected static $_alias = 'a';
    protected static $_dbConnectName = 'account';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'uk' => array('name' => 'uk',
                'type' => 'string',
                'db_type' => 'char(15)',
                'length' => 15),
        'name' => array('name' => 'name',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'version' => array('name' => 'version',
                'default' => 1,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'currency' => array('name' => 'currency',
                'type' => 'string',
                'db_type' => 'enum(\'VND\',\'USD\',\'CNY\')',
                'length' => 3),
        'balance' => array('name' => 'balance',
                'default' => 0.00,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'double(20,2)',
                'length' => 20),
        'frozen_balance' => array('name' => 'frozen_balance',
                'default' => 0.00,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'double(20,2)',
                'length' => 20),
        'status' => array('name' => 'status',
                'default' => 'NORMAL',
                'type' => 'string',
                'db_type' => 'enum(\'NORMAL\',\'FROZEN\',\'DELETED\')',
                'length' => 7),
        'type' => array('name' => 'type',
                'default' => 'NORMAL',
                'type' => 'string',
                'db_type' => 'enum(\'NORMAL\',\'SYSTEM\',\'FEE\',\'PARTNER\')',
                'length' => 7),
        'crc' => array('name' => 'crc',
                'type' => 'string',
                'db_type' => 'char(64)',
                'length' => 64),
        'created_time' => array('name' => 'created_time',
                'default' => '0000-00-00 00:00:00',
                'type' => 'string',
                'db_type' => 'datetime'),
        'modified_time' => array('name' => 'modified_time',
                'type' => 'string',
                'db_type' => 'timestamp'),
);
    protected static $_validate = array(
        'uk' => array('require' => '"uk" is required!',
                'unique' => 'uk\'s values has already been taken'),
        'version' => array('require' => '"version" is required!'),
        'currency' => array('require' => '"currency" is required!',
                'filter' => array('allow' => array('VND','USD','CNY'),
                            'message' => 'currency\'s values is not allowed')),
        'balance' => array('require' => '"balance" is required!'),
        'frozen_balance' => array('require' => '"frozen_balance" is required!'),
        'status' => array('require' => '"status" is required!',
                'filter' => array('allow' => array('NORMAL','FROZEN','DELETED'),
                            'message' => 'status\'s values is not allowed')),
        'type' => array('require' => '"type" is required!',
                'filter' => array('allow' => array('NORMAL','SYSTEM','FEE','PARTNER'),
                            'message' => 'type\'s values is not allowed')),
        'crc' => array('require' => '"crc" is required!'),
        'created_time' => array('require' => '"created_time" is required!'),
);
    protected static $_cols = array('id','uk','name','version','currency','balance','frozen_balance','status','type','crc','created_time','modified_time');

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