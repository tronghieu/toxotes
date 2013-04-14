<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * WithdrawFee
 *  This class has been auto-generated at 03/04/2013 14:50:59
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $with_id with_id type : int(11) unsigned
 * @property integer $trans_id trans_id type : int(11) unsigned

 * @method static \WithdrawFee[] findById(integer $id) find objects in database by id
 * @method static \WithdrawFee findOneById(integer $id) find object in database by id
 * @method static \WithdrawFee[] findByWithId(integer $with_id) find objects in database by with_id
 * @method static \WithdrawFee findOneByWithId(integer $with_id) find object in database by with_id
 * @method static \WithdrawFee[] findByTransId(integer $trans_id) find objects in database by trans_id
 * @method static \WithdrawFee findOneByTransId(integer $trans_id) find object in database by trans_id

 */
abstract class WithdrawFeeBase extends ActiveRecord {
    protected static $_tableName = 'withdraw_fee';
    protected static $_pk = 'id';
    protected static $_alias = 'w';
    protected static $_dbConnectName = 'withdraw_fee';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'with_id' => array('name' => 'with_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'trans_id' => array('name' => 'trans_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
);
    protected static $_validate = array(
        'with_id' => array('require' => '"with_id" is required!'),
        'trans_id' => array('require' => '"trans_id" is required!'),
);
    protected static $_cols = array('id','with_id','trans_id');

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