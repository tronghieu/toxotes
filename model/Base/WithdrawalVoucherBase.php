<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * WithdrawalVoucher
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $uid uid type : char(16) max_length : 16
 * @property integer $customer_id customer_id type : int(11)
 * @property number $amount amount type : double(10,2)
 * @property string $state state type : enum('INIT','PENDING','SUPPEND','FINISH') max_length : 7
 * @property string $note note type : text max_length : 
 * @property string $meta_date meta_date type : text max_length : 
 * @property string $bank_journal_entry bank_journal_entry type : varchar(255) max_length : 255
 * @property integer $created_by created_by type : int(11)
 * @property integer $approved_by approved_by type : int(11)
 * @property datetime $created_time created_time type : datetime
 * @property datetime $finished_time finished_time type : datetime
 * @property datetime $pending_time pending_time type : datetime
 * @property datetime $suspended_time suspended_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \WithdrawalVoucher[] findById(integer $id) find objects in database by id
 * @method static \WithdrawalVoucher findOneById(integer $id) find object in database by id
 * @method static \WithdrawalVoucher retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setUid(string $uid) set uid value
 * @method string getUid() get uid value
 * @method static \WithdrawalVoucher[] findByUid(string $uid) find objects in database by uid
 * @method static \WithdrawalVoucher findOneByUid(string $uid) find object in database by uid
 * @method static \WithdrawalVoucher retrieveByUid(string $uid) retrieve object from poll by uid, get it from db if not exist in poll

 * @method void setCustomerId(integer $customer_id) set customer_id value
 * @method integer getCustomerId() get customer_id value
 * @method static \WithdrawalVoucher[] findByCustomerId(integer $customer_id) find objects in database by customer_id
 * @method static \WithdrawalVoucher findOneByCustomerId(integer $customer_id) find object in database by customer_id
 * @method static \WithdrawalVoucher retrieveByCustomerId(integer $customer_id) retrieve object from poll by customer_id, get it from db if not exist in poll

 * @method void setAmount(number $amount) set amount value
 * @method number getAmount() get amount value
 * @method static \WithdrawalVoucher[] findByAmount(number $amount) find objects in database by amount
 * @method static \WithdrawalVoucher findOneByAmount(number $amount) find object in database by amount
 * @method static \WithdrawalVoucher retrieveByAmount(number $amount) retrieve object from poll by amount, get it from db if not exist in poll

 * @method void setState(string $state) set state value
 * @method string getState() get state value
 * @method static \WithdrawalVoucher[] findByState(string $state) find objects in database by state
 * @method static \WithdrawalVoucher findOneByState(string $state) find object in database by state
 * @method static \WithdrawalVoucher retrieveByState(string $state) retrieve object from poll by state, get it from db if not exist in poll

 * @method void setNote(string $note) set note value
 * @method string getNote() get note value
 * @method static \WithdrawalVoucher[] findByNote(string $note) find objects in database by note
 * @method static \WithdrawalVoucher findOneByNote(string $note) find object in database by note
 * @method static \WithdrawalVoucher retrieveByNote(string $note) retrieve object from poll by note, get it from db if not exist in poll

 * @method void setMetaDate(string $meta_date) set meta_date value
 * @method string getMetaDate() get meta_date value
 * @method static \WithdrawalVoucher[] findByMetaDate(string $meta_date) find objects in database by meta_date
 * @method static \WithdrawalVoucher findOneByMetaDate(string $meta_date) find object in database by meta_date
 * @method static \WithdrawalVoucher retrieveByMetaDate(string $meta_date) retrieve object from poll by meta_date, get it from db if not exist in poll

 * @method void setBankJournalEntry(string $bank_journal_entry) set bank_journal_entry value
 * @method string getBankJournalEntry() get bank_journal_entry value
 * @method static \WithdrawalVoucher[] findByBankJournalEntry(string $bank_journal_entry) find objects in database by bank_journal_entry
 * @method static \WithdrawalVoucher findOneByBankJournalEntry(string $bank_journal_entry) find object in database by bank_journal_entry
 * @method static \WithdrawalVoucher retrieveByBankJournalEntry(string $bank_journal_entry) retrieve object from poll by bank_journal_entry, get it from db if not exist in poll

 * @method void setCreatedBy(integer $created_by) set created_by value
 * @method integer getCreatedBy() get created_by value
 * @method static \WithdrawalVoucher[] findByCreatedBy(integer $created_by) find objects in database by created_by
 * @method static \WithdrawalVoucher findOneByCreatedBy(integer $created_by) find object in database by created_by
 * @method static \WithdrawalVoucher retrieveByCreatedBy(integer $created_by) retrieve object from poll by created_by, get it from db if not exist in poll

 * @method void setApprovedBy(integer $approved_by) set approved_by value
 * @method integer getApprovedBy() get approved_by value
 * @method static \WithdrawalVoucher[] findByApprovedBy(integer $approved_by) find objects in database by approved_by
 * @method static \WithdrawalVoucher findOneByApprovedBy(integer $approved_by) find object in database by approved_by
 * @method static \WithdrawalVoucher retrieveByApprovedBy(integer $approved_by) retrieve object from poll by approved_by, get it from db if not exist in poll

 * @method void setCreatedTime(\Flywheel\Db\Type\DateTime $created_time) setCreatedTime(string $created_time) set created_time value
 * @method \Flywheel\Db\Type\DateTime getCreatedTime() get created_time value
 * @method static \WithdrawalVoucher[] findByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \WithdrawalVoucher findOneByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \WithdrawalVoucher retrieveByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) retrieveByCreatedTime(string $created_time) retrieve object from poll by created_time, get it from db if not exist in poll

 * @method void setFinishedTime(\Flywheel\Db\Type\DateTime $finished_time) setFinishedTime(string $finished_time) set finished_time value
 * @method \Flywheel\Db\Type\DateTime getFinishedTime() get finished_time value
 * @method static \WithdrawalVoucher[] findByFinishedTime(\Flywheel\Db\Type\DateTime $finished_time) findByFinishedTime(string $finished_time) find objects in database by finished_time
 * @method static \WithdrawalVoucher findOneByFinishedTime(\Flywheel\Db\Type\DateTime $finished_time) findOneByFinishedTime(string $finished_time) find object in database by finished_time
 * @method static \WithdrawalVoucher retrieveByFinishedTime(\Flywheel\Db\Type\DateTime $finished_time) retrieveByFinishedTime(string $finished_time) retrieve object from poll by finished_time, get it from db if not exist in poll

 * @method void setPendingTime(\Flywheel\Db\Type\DateTime $pending_time) setPendingTime(string $pending_time) set pending_time value
 * @method \Flywheel\Db\Type\DateTime getPendingTime() get pending_time value
 * @method static \WithdrawalVoucher[] findByPendingTime(\Flywheel\Db\Type\DateTime $pending_time) findByPendingTime(string $pending_time) find objects in database by pending_time
 * @method static \WithdrawalVoucher findOneByPendingTime(\Flywheel\Db\Type\DateTime $pending_time) findOneByPendingTime(string $pending_time) find object in database by pending_time
 * @method static \WithdrawalVoucher retrieveByPendingTime(\Flywheel\Db\Type\DateTime $pending_time) retrieveByPendingTime(string $pending_time) retrieve object from poll by pending_time, get it from db if not exist in poll

 * @method void setSuspendedTime(\Flywheel\Db\Type\DateTime $suspended_time) setSuspendedTime(string $suspended_time) set suspended_time value
 * @method \Flywheel\Db\Type\DateTime getSuspendedTime() get suspended_time value
 * @method static \WithdrawalVoucher[] findBySuspendedTime(\Flywheel\Db\Type\DateTime $suspended_time) findBySuspendedTime(string $suspended_time) find objects in database by suspended_time
 * @method static \WithdrawalVoucher findOneBySuspendedTime(\Flywheel\Db\Type\DateTime $suspended_time) findOneBySuspendedTime(string $suspended_time) find object in database by suspended_time
 * @method static \WithdrawalVoucher retrieveBySuspendedTime(\Flywheel\Db\Type\DateTime $suspended_time) retrieveBySuspendedTime(string $suspended_time) retrieve object from poll by suspended_time, get it from db if not exist in poll


 */
abstract class WithdrawalVoucherBase extends ActiveRecord {
    protected static $_tableName = 'withdrawal_voucher';
    protected static $_phpName = 'WithdrawalVoucher';
    protected static $_pk = 'id';
    protected static $_alias = 'w';
    protected static $_dbConnectName = 'withdrawal_voucher';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'uid' => array('name' => 'uid',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'char(16)',
                'length' => 16),
        'customer_id' => array('name' => 'customer_id',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'amount' => array('name' => 'amount',
                'default' => 0.00,
                'not_null' => true,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'double(10,2)',
                'length' => 10),
        'state' => array('name' => 'state',
                'default' => 'INIT',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'INIT\',\'PENDING\',\'SUPPEND\',\'FINISH\')',
                'length' => 7),
        'note' => array('name' => 'note',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'meta_date' => array('name' => 'meta_date',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'bank_journal_entry' => array('name' => 'bank_journal_entry',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'created_by' => array('name' => 'created_by',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'approved_by' => array('name' => 'approved_by',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'created_time' => array('name' => 'created_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'finished_time' => array('name' => 'finished_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'pending_time' => array('name' => 'pending_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'suspended_time' => array('name' => 'suspended_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
     );
    protected static $_validate = array(
        'state' => array(
            array('name' => 'ValidValues',
                'value' => 'INIT|PENDING|SUPPEND|FINISH',
                'message'=> 'state\'s values is not allowed'
            ),
        ),
    );
    protected static $_validatorRules = array(
        'state' => array(
            array('name' => 'ValidValues',
                'value' => 'INIT|PENDING|SUPPEND|FINISH',
                'message'=> 'state\'s values is not allowed'
            ),
        ),
    );
    protected static $_init = false;
    protected static $_cols = array('id','uid','customer_id','amount','state','note','meta_date','bank_journal_entry','created_by','approved_by','created_time','finished_time','pending_time','suspended_time');

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