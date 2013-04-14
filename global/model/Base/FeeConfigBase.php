<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * FeeConfig
 *  This class has been auto-generated at 03/04/2013 14:50:59
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $scope scope type : enum('DEPOSIT','WITHDRAW','TRANSFER') max_length : 8
 * @property string $apply_to apply_to type : enum('DEFAULT','DEFINED_ACC') max_length : 11
 * @property integer $apply_acc apply_acc type : int(11) unsigned
 * @property number $amount_from amount_from type : decimal(20,2)
 * @property number $amount_to amount_to type : decimal(20,2)
 * @property number $percentage_fee percentage_fee type : decimal(6,2)
 * @property number $fixed_fee fixed_fee type : decimal(20,2)
 * @property string $currency currency type : enum('VND','USD','CNY') max_length : 3
 * @property string $valid_time valid_time type : datetime max_length : 
 * @property string $invalid_time invalid_time type : datetime max_length : 
 * @property string $created_time created_time type : datetime max_length : 
 * @property string $modified_time modified_time type : timestamp max_length : 

 * @method static \FeeConfig[] findById(integer $id) find objects in database by id
 * @method static \FeeConfig findOneById(integer $id) find object in database by id
 * @method static \FeeConfig[] findByScope(string $scope) find objects in database by scope
 * @method static \FeeConfig findOneByScope(string $scope) find object in database by scope
 * @method static \FeeConfig[] findByApplyTo(string $apply_to) find objects in database by apply_to
 * @method static \FeeConfig findOneByApplyTo(string $apply_to) find object in database by apply_to
 * @method static \FeeConfig[] findByApplyAcc(integer $apply_acc) find objects in database by apply_acc
 * @method static \FeeConfig findOneByApplyAcc(integer $apply_acc) find object in database by apply_acc
 * @method static \FeeConfig[] findByAmountFrom(number $amount_from) find objects in database by amount_from
 * @method static \FeeConfig findOneByAmountFrom(number $amount_from) find object in database by amount_from
 * @method static \FeeConfig[] findByAmountTo(number $amount_to) find objects in database by amount_to
 * @method static \FeeConfig findOneByAmountTo(number $amount_to) find object in database by amount_to
 * @method static \FeeConfig[] findByPercentageFee(number $percentage_fee) find objects in database by percentage_fee
 * @method static \FeeConfig findOneByPercentageFee(number $percentage_fee) find object in database by percentage_fee
 * @method static \FeeConfig[] findByFixedFee(number $fixed_fee) find objects in database by fixed_fee
 * @method static \FeeConfig findOneByFixedFee(number $fixed_fee) find object in database by fixed_fee
 * @method static \FeeConfig[] findByCurrency(string $currency) find objects in database by currency
 * @method static \FeeConfig findOneByCurrency(string $currency) find object in database by currency
 * @method static \FeeConfig[] findByValidTime(string $valid_time) find objects in database by valid_time
 * @method static \FeeConfig findOneByValidTime(string $valid_time) find object in database by valid_time
 * @method static \FeeConfig[] findByInvalidTime(string $invalid_time) find objects in database by invalid_time
 * @method static \FeeConfig findOneByInvalidTime(string $invalid_time) find object in database by invalid_time
 * @method static \FeeConfig[] findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \FeeConfig findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \FeeConfig[] findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \FeeConfig findOneByModifiedTime(string $modified_time) find object in database by modified_time

 */
abstract class FeeConfigBase extends ActiveRecord {
    protected static $_tableName = 'fee_config';
    protected static $_pk = 'id';
    protected static $_alias = 'f';
    protected static $_dbConnectName = 'fee_config';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'scope' => array('name' => 'scope',
                'type' => 'string',
                'db_type' => 'enum(\'DEPOSIT\',\'WITHDRAW\',\'TRANSFER\')',
                'length' => 8),
        'apply_to' => array('name' => 'apply_to',
                'default' => 'DEFAULT',
                'type' => 'string',
                'db_type' => 'enum(\'DEFAULT\',\'DEFINED_ACC\')',
                'length' => 11),
        'apply_acc' => array('name' => 'apply_acc',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'amount_from' => array('name' => 'amount_from',
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(20,2)',
                'length' => 20),
        'amount_to' => array('name' => 'amount_to',
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(20,2)',
                'length' => 20),
        'percentage_fee' => array('name' => 'percentage_fee',
                'default' => 0.00,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(6,2)',
                'length' => 6),
        'fixed_fee' => array('name' => 'fixed_fee',
                'default' => 0.00,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(20,2)',
                'length' => 20),
        'currency' => array('name' => 'currency',
                'type' => 'string',
                'db_type' => 'enum(\'VND\',\'USD\',\'CNY\')',
                'length' => 3),
        'valid_time' => array('name' => 'valid_time',
                'default' => '0000-00-00 00:00:00',
                'type' => 'string',
                'db_type' => 'datetime'),
        'invalid_time' => array('name' => 'invalid_time',
                'default' => '0000-00-00 00:00:00',
                'type' => 'string',
                'db_type' => 'datetime'),
        'created_time' => array('name' => 'created_time',
                'default' => '0000-00-00 00:00:00',
                'type' => 'string',
                'db_type' => 'datetime'),
        'modified_time' => array('name' => 'modified_time',
                'type' => 'string',
                'db_type' => 'timestamp'),
);
    protected static $_validate = array(
        'scope' => array('require' => '"scope" is required!',
                'filter' => array('allow' => array('DEPOSIT','WITHDRAW','TRANSFER'),
                            'message' => 'scope\'s values is not allowed')),
        'apply_to' => array('require' => '"apply_to" is required!',
                'filter' => array('allow' => array('DEFAULT','DEFINED_ACC'),
                            'message' => 'apply_to\'s values is not allowed')),
        'apply_acc' => array('require' => '"apply_acc" is required!'),
        'amount_from' => array('require' => '"amount_from" is required!'),
        'amount_to' => array('require' => '"amount_to" is required!'),
        'percentage_fee' => array('require' => '"percentage_fee" is required!'),
        'fixed_fee' => array('require' => '"fixed_fee" is required!'),
        'currency' => array('require' => '"currency" is required!',
                'filter' => array('allow' => array('VND','USD','CNY'),
                            'message' => 'currency\'s values is not allowed')),
        'valid_time' => array('require' => '"valid_time" is required!'),
        'invalid_time' => array('require' => '"invalid_time" is required!'),
        'created_time' => array('require' => '"created_time" is required!'),
);
    protected static $_cols = array('id','scope','apply_to','apply_acc','amount_from','amount_to','percentage_fee','fixed_fee','currency','valid_time','invalid_time','created_time','modified_time');

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