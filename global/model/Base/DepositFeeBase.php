<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * DepositFee
 *  This class has been auto-generated at 03/04/2013 14:50:59
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $dep_id dep_id type : int(11) unsigned
 * @property integer $trans_id trans_id type : int(11) unsigned

 * @method static \DepositFee[] findById(integer $id) find objects in database by id
 * @method static \DepositFee findOneById(integer $id) find object in database by id
 * @method static \DepositFee[] findByDepId(integer $dep_id) find objects in database by dep_id
 * @method static \DepositFee findOneByDepId(integer $dep_id) find object in database by dep_id
 * @method static \DepositFee[] findByTransId(integer $trans_id) find objects in database by trans_id
 * @method static \DepositFee findOneByTransId(integer $trans_id) find object in database by trans_id

 */
abstract class DepositFeeBase extends ActiveRecord {
    protected static $_tableName = 'deposit_fee';
    protected static $_pk = 'id';
    protected static $_alias = 'd';
    protected static $_dbConnectName = 'deposit_fee';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'dep_id' => array('name' => 'dep_id',
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
        'dep_id' => array('require' => '"dep_id" is required!'),
        'trans_id' => array('require' => '"trans_id" is required!'),
);
    protected static $_cols = array('id','dep_id','trans_id');

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