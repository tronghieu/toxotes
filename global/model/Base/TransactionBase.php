<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Transaction
 *  This class has been auto-generated at 03/04/2013 14:50:59
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $uk uk type : char(39) max_length : 39
 * @property integer $version version type : int(11)
 * @property string $currency currency type : enum('VND','USD','CNY') max_length : 3
 * @property number $amount amount type : decimal(20,2)
 * @property integer $from_acc from_acc type : int(11) unsigned
 * @property integer $to_acc to_acc type : int(11) unsigned
 * @property integer $money_transfer money_transfer type : tinyint(1)
 * @property string $fee_for fee_for type : enum('NONE','FROM_ACC','TO_ACC') max_length : 8
 * @property integer $charged_fee charged_fee type : tinyint(4)
 * @property number $total_fee total_fee type : decimal(20,2)
 * @property number $external_fee external_fee type : decimal(20,2)
 * @property number $fee_before_vat fee_before_vat type : decimal(20,2)
 * @property string $note note type : text max_length : 
 * @property string $external_code external_code type : varchar(255) max_length : 255
 * @property string $status status type : enum('INIT','SUSPENDED','CANCELLED','FINISHED','EXPIRED') max_length : 9
 * @property string $type type type : enum('TRANSFER','FEE','REFUND') max_length : 8
 * @property integer $relate_to relate_to type : int(11)
 * @property string $crc crc type : char(64) max_length : 64
 * @property string $created_time created_time type : datetime max_length : 
 * @property string $expired_time expired_time type : datetime max_length : 
 * @property string $modified_time modified_time type : timestamp max_length : 

 * @method static \Transaction[] findById(integer $id) find objects in database by id
 * @method static \Transaction findOneById(integer $id) find object in database by id
 * @method static \Transaction[] findByUk(string $uk) find objects in database by uk
 * @method static \Transaction findOneByUk(string $uk) find object in database by uk
 * @method static \Transaction[] findByVersion(integer $version) find objects in database by version
 * @method static \Transaction findOneByVersion(integer $version) find object in database by version
 * @method static \Transaction[] findByCurrency(string $currency) find objects in database by currency
 * @method static \Transaction findOneByCurrency(string $currency) find object in database by currency
 * @method static \Transaction[] findByAmount(number $amount) find objects in database by amount
 * @method static \Transaction findOneByAmount(number $amount) find object in database by amount
 * @method static \Transaction[] findByFromAcc(integer $from_acc) find objects in database by from_acc
 * @method static \Transaction findOneByFromAcc(integer $from_acc) find object in database by from_acc
 * @method static \Transaction[] findByToAcc(integer $to_acc) find objects in database by to_acc
 * @method static \Transaction findOneByToAcc(integer $to_acc) find object in database by to_acc
 * @method static \Transaction[] findByMoneyTransfer(integer $money_transfer) find objects in database by money_transfer
 * @method static \Transaction findOneByMoneyTransfer(integer $money_transfer) find object in database by money_transfer
 * @method static \Transaction[] findByFeeFor(string $fee_for) find objects in database by fee_for
 * @method static \Transaction findOneByFeeFor(string $fee_for) find object in database by fee_for
 * @method static \Transaction[] findByChargedFee(integer $charged_fee) find objects in database by charged_fee
 * @method static \Transaction findOneByChargedFee(integer $charged_fee) find object in database by charged_fee
 * @method static \Transaction[] findByTotalFee(number $total_fee) find objects in database by total_fee
 * @method static \Transaction findOneByTotalFee(number $total_fee) find object in database by total_fee
 * @method static \Transaction[] findByExternalFee(number $external_fee) find objects in database by external_fee
 * @method static \Transaction findOneByExternalFee(number $external_fee) find object in database by external_fee
 * @method static \Transaction[] findByFeeBeforeVat(number $fee_before_vat) find objects in database by fee_before_vat
 * @method static \Transaction findOneByFeeBeforeVat(number $fee_before_vat) find object in database by fee_before_vat
 * @method static \Transaction[] findByNote(string $note) find objects in database by note
 * @method static \Transaction findOneByNote(string $note) find object in database by note
 * @method static \Transaction[] findByExternalCode(string $external_code) find objects in database by external_code
 * @method static \Transaction findOneByExternalCode(string $external_code) find object in database by external_code
 * @method static \Transaction[] findByStatus(string $status) find objects in database by status
 * @method static \Transaction findOneByStatus(string $status) find object in database by status
 * @method static \Transaction[] findByType(string $type) find objects in database by type
 * @method static \Transaction findOneByType(string $type) find object in database by type
 * @method static \Transaction[] findByRelateTo(integer $relate_to) find objects in database by relate_to
 * @method static \Transaction findOneByRelateTo(integer $relate_to) find object in database by relate_to
 * @method static \Transaction[] findByCrc(string $crc) find objects in database by crc
 * @method static \Transaction findOneByCrc(string $crc) find object in database by crc
 * @method static \Transaction[] findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \Transaction findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \Transaction[] findByExpiredTime(string $expired_time) find objects in database by expired_time
 * @method static \Transaction findOneByExpiredTime(string $expired_time) find object in database by expired_time
 * @method static \Transaction[] findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \Transaction findOneByModifiedTime(string $modified_time) find object in database by modified_time

 */
abstract class TransactionBase extends ActiveRecord {
    protected static $_tableName = 'transaction';
    protected static $_pk = 'id';
    protected static $_alias = 't';
    protected static $_dbConnectName = 'transaction';
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
                'db_type' => 'char(39)',
                'length' => 39),
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
        'amount' => array('name' => 'amount',
                'default' => 0.00,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(20,2)',
                'length' => 20),
        'from_acc' => array('name' => 'from_acc',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'to_acc' => array('name' => 'to_acc',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'money_transfer' => array('name' => 'money_transfer',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'fee_for' => array('name' => 'fee_for',
                'type' => 'string',
                'db_type' => 'enum(\'NONE\',\'FROM_ACC\',\'TO_ACC\')',
                'length' => 8),
        'charged_fee' => array('name' => 'charged_fee',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(4)',
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
        'note' => array('name' => 'note',
                'type' => 'string',
                'db_type' => 'text'),
        'external_code' => array('name' => 'external_code',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'status' => array('name' => 'status',
                'default' => 'INIT',
                'type' => 'string',
                'db_type' => 'enum(\'INIT\',\'SUSPENDED\',\'CANCELLED\',\'FINISHED\',\'EXPIRED\')',
                'length' => 9),
        'type' => array('name' => 'type',
                'type' => 'string',
                'db_type' => 'enum(\'TRANSFER\',\'FEE\',\'REFUND\')',
                'length' => 8),
        'relate_to' => array('name' => 'relate_to',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'crc' => array('name' => 'crc',
                'type' => 'string',
                'db_type' => 'char(64)',
                'length' => 64),
        'created_time' => array('name' => 'created_time',
                'default' => '0000-00-00 00:00:00',
                'type' => 'string',
                'db_type' => 'datetime'),
        'expired_time' => array('name' => 'expired_time',
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
        'amount' => array('require' => '"amount" is required!'),
        'from_acc' => array('require' => '"from_acc" is required!'),
        'to_acc' => array('require' => '"to_acc" is required!'),
        'money_transfer' => array('require' => '"money_transfer" is required!'),
        'fee_for' => array('require' => '"fee_for" is required!',
                'filter' => array('allow' => array('NONE','FROM_ACC','TO_ACC'),
                            'message' => 'fee_for\'s values is not allowed')),
        'charged_fee' => array('require' => '"charged_fee" is required!'),
        'total_fee' => array('require' => '"total_fee" is required!'),
        'external_fee' => array('require' => '"external_fee" is required!'),
        'fee_before_vat' => array('require' => '"fee_before_vat" is required!'),
        'status' => array('require' => '"status" is required!',
                'filter' => array('allow' => array('INIT','SUSPENDED','CANCELLED','FINISHED','EXPIRED'),
                            'message' => 'status\'s values is not allowed')),
        'type' => array('require' => '"type" is required!',
                'filter' => array('allow' => array('TRANSFER','FEE','REFUND'),
                            'message' => 'type\'s values is not allowed')),
        'relate_to' => array('require' => '"relate_to" is required!'),
        'crc' => array('require' => '"crc" is required!'),
        'created_time' => array('require' => '"created_time" is required!'),
        'expired_time' => array('require' => '"expired_time" is required!'),
);
    protected static $_cols = array('id','uk','version','currency','amount','from_acc','to_acc','money_transfer','fee_for','charged_fee','total_fee','external_fee','fee_before_vat','note','external_code','status','type','relate_to','crc','created_time','expired_time','modified_time');

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