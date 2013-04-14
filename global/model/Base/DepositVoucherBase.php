<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * DepositVoucher
 *  This class has been auto-generated at 03/04/2013 14:50:59
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $uk uk type : char(23) max_length : 23
 * @property integer $version version type : int(11)
 * @property integer $acc_id acc_id type : int(11) unsigned
 * @property string $currency currency type : enum('VND','USD','CNY') max_length : 3
 * @property string $note note type : text max_length : 
 * @property string $external_code external_code type : varchar(255) max_length : 255
 * @property number $amount amount type : decimal(20,2)
 * @property string $status status type : enum('INIT','SUSPENDED','CANCELLED','FINISHED','EXPIRED') max_length : 9
 * @property integer $money_in money_in type : tinyint(1)
 * @property integer $charged_fee charged_fee type : tinyint(1)
 * @property number $total_fee total_fee type : decimal(20,2)
 * @property number $external_fee external_fee type : decimal(20,2)
 * @property number $fee_before_vat fee_before_vat type : decimal(20,2)
 * @property string $crc crc type : char(64) max_length : 64
 * @property string $created_time created_time type : datetime max_length : 
 * @property string $expired_time expired_time type : datetime max_length : 
 * @property string $modified_time modified_time type : timestamp max_length : 

 * @method static \DepositVoucher[] findById(integer $id) find objects in database by id
 * @method static \DepositVoucher findOneById(integer $id) find object in database by id
 * @method static \DepositVoucher[] findByUk(string $uk) find objects in database by uk
 * @method static \DepositVoucher findOneByUk(string $uk) find object in database by uk
 * @method static \DepositVoucher[] findByVersion(integer $version) find objects in database by version
 * @method static \DepositVoucher findOneByVersion(integer $version) find object in database by version
 * @method static \DepositVoucher[] findByAccId(integer $acc_id) find objects in database by acc_id
 * @method static \DepositVoucher findOneByAccId(integer $acc_id) find object in database by acc_id
 * @method static \DepositVoucher[] findByCurrency(string $currency) find objects in database by currency
 * @method static \DepositVoucher findOneByCurrency(string $currency) find object in database by currency
 * @method static \DepositVoucher[] findByNote(string $note) find objects in database by note
 * @method static \DepositVoucher findOneByNote(string $note) find object in database by note
 * @method static \DepositVoucher[] findByExternalCode(string $external_code) find objects in database by external_code
 * @method static \DepositVoucher findOneByExternalCode(string $external_code) find object in database by external_code
 * @method static \DepositVoucher[] findByAmount(number $amount) find objects in database by amount
 * @method static \DepositVoucher findOneByAmount(number $amount) find object in database by amount
 * @method static \DepositVoucher[] findByStatus(string $status) find objects in database by status
 * @method static \DepositVoucher findOneByStatus(string $status) find object in database by status
 * @method static \DepositVoucher[] findByMoneyIn(integer $money_in) find objects in database by money_in
 * @method static \DepositVoucher findOneByMoneyIn(integer $money_in) find object in database by money_in
 * @method static \DepositVoucher[] findByChargedFee(integer $charged_fee) find objects in database by charged_fee
 * @method static \DepositVoucher findOneByChargedFee(integer $charged_fee) find object in database by charged_fee
 * @method static \DepositVoucher[] findByTotalFee(number $total_fee) find objects in database by total_fee
 * @method static \DepositVoucher findOneByTotalFee(number $total_fee) find object in database by total_fee
 * @method static \DepositVoucher[] findByExternalFee(number $external_fee) find objects in database by external_fee
 * @method static \DepositVoucher findOneByExternalFee(number $external_fee) find object in database by external_fee
 * @method static \DepositVoucher[] findByFeeBeforeVat(number $fee_before_vat) find objects in database by fee_before_vat
 * @method static \DepositVoucher findOneByFeeBeforeVat(number $fee_before_vat) find object in database by fee_before_vat
 * @method static \DepositVoucher[] findByCrc(string $crc) find objects in database by crc
 * @method static \DepositVoucher findOneByCrc(string $crc) find object in database by crc
 * @method static \DepositVoucher[] findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \DepositVoucher findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \DepositVoucher[] findByExpiredTime(string $expired_time) find objects in database by expired_time
 * @method static \DepositVoucher findOneByExpiredTime(string $expired_time) find object in database by expired_time
 * @method static \DepositVoucher[] findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \DepositVoucher findOneByModifiedTime(string $modified_time) find object in database by modified_time

 */
abstract class DepositVoucherBase extends ActiveRecord {
    protected static $_tableName = 'deposit_voucher';
    protected static $_pk = 'id';
    protected static $_alias = 'd';
    protected static $_dbConnectName = 'deposit_voucher';
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
                'db_type' => 'char(23)',
                'length' => 23),
        'version' => array('name' => 'version',
                'default' => 1,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'acc_id' => array('name' => 'acc_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'currency' => array('name' => 'currency',
                'type' => 'string',
                'db_type' => 'enum(\'VND\',\'USD\',\'CNY\')',
                'length' => 3),
        'note' => array('name' => 'note',
                'type' => 'string',
                'db_type' => 'text'),
        'external_code' => array('name' => 'external_code',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'amount' => array('name' => 'amount',
                'default' => 0.00,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(20,2)',
                'length' => 20),
        'status' => array('name' => 'status',
                'default' => 'INIT',
                'type' => 'string',
                'db_type' => 'enum(\'INIT\',\'SUSPENDED\',\'CANCELLED\',\'FINISHED\',\'EXPIRED\')',
                'length' => 9),
        'money_in' => array('name' => 'money_in',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'charged_fee' => array('name' => 'charged_fee',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'total_fee' => array('name' => 'total_fee',
                'default' => 0.00,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(20,2)',
                'length' => 20),
        'external_fee' => array('name' => 'external_fee',
                'default' => 0.00,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(20,2)',
                'length' => 20),
        'fee_before_vat' => array('name' => 'fee_before_vat',
                'default' => 0.00,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(20,2)',
                'length' => 20),
        'crc' => array('name' => 'crc',
                'type' => 'string',
                'db_type' => 'char(64)',
                'length' => 64),
        'created_time' => array('name' => 'created_time',
                'type' => 'string',
                'db_type' => 'datetime'),
        'expired_time' => array('name' => 'expired_time',
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
        'acc_id' => array('require' => '"acc_id" is required!'),
        'currency' => array('require' => '"currency" is required!',
                'filter' => array('allow' => array('VND','USD','CNY'),
                            'message' => 'currency\'s values is not allowed')),
        'amount' => array('require' => '"amount" is required!'),
        'status' => array('require' => '"status" is required!',
                'filter' => array('allow' => array('INIT','SUSPENDED','CANCELLED','FINISHED','EXPIRED'),
                            'message' => 'status\'s values is not allowed')),
        'money_in' => array('require' => '"money_in" is required!'),
        'charged_fee' => array('require' => '"charged_fee" is required!'),
        'total_fee' => array('require' => '"total_fee" is required!'),
        'external_fee' => array('require' => '"external_fee" is required!'),
        'fee_before_vat' => array('require' => '"fee_before_vat" is required!'),
        'crc' => array('require' => '"crc" is required!'),
        'created_time' => array('require' => '"created_time" is required!'),
        'expired_time' => array('require' => '"expired_time" is required!'),
);
    protected static $_cols = array('id','uk','version','acc_id','currency','note','external_code','amount','status','money_in','charged_fee','total_fee','external_fee','fee_before_vat','crc','created_time','expired_time','modified_time');

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