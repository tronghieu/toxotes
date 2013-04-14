<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * CosData
 *  This class has been auto-generated at 03/04/2013 14:50:59
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $cos_id cos_id type : int(11) unsigned
 * @property string $currency currency type : varchar(10) max_length : 10
 * @property string $cos_key cos_key type : varchar(100) max_length : 100
 * @property number $cos_value cos_value type : decimal(20,2)

 * @method static \CosData[] findById(integer $id) find objects in database by id
 * @method static \CosData findOneById(integer $id) find object in database by id
 * @method static \CosData[] findByCosId(integer $cos_id) find objects in database by cos_id
 * @method static \CosData findOneByCosId(integer $cos_id) find object in database by cos_id
 * @method static \CosData[] findByCurrency(string $currency) find objects in database by currency
 * @method static \CosData findOneByCurrency(string $currency) find object in database by currency
 * @method static \CosData[] findByCosKey(string $cos_key) find objects in database by cos_key
 * @method static \CosData findOneByCosKey(string $cos_key) find object in database by cos_key
 * @method static \CosData[] findByCosValue(number $cos_value) find objects in database by cos_value
 * @method static \CosData findOneByCosValue(number $cos_value) find object in database by cos_value

 */
abstract class CosDataBase extends ActiveRecord {
    protected static $_tableName = 'cos_data';
    protected static $_pk = 'id';
    protected static $_alias = 'c';
    protected static $_dbConnectName = 'cos_data';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'cos_id' => array('name' => 'cos_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'currency' => array('name' => 'currency',
                'type' => 'string',
                'db_type' => 'varchar(10)',
                'length' => 10),
        'cos_key' => array('name' => 'cos_key',
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'cos_value' => array('name' => 'cos_value',
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(20,2)',
                'length' => 20),
);
    protected static $_validate = array(
        'cos_id' => array('require' => '"cos_id" is required!'),
        'currency' => array('require' => '"currency" is required!'),
        'cos_key' => array('require' => '"cos_key" is required!'),
        'cos_value' => array('require' => '"cos_value" is required!'),
);
    protected static $_cols = array('id','cos_id','currency','cos_key','cos_value');

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