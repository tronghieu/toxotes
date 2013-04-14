<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * ConsumerAcl
 *  This class has been auto-generated at 03/04/2013 14:50:59
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $consumer_id consumer_id type : int(11) unsigned
 * @property string $api_method api_method type : varchar(255) max_length : 255
 * @property integer $access access type : tinyint(1)

 * @method static \ConsumerAcl[] findById(integer $id) find objects in database by id
 * @method static \ConsumerAcl findOneById(integer $id) find object in database by id
 * @method static \ConsumerAcl[] findByConsumerId(integer $consumer_id) find objects in database by consumer_id
 * @method static \ConsumerAcl findOneByConsumerId(integer $consumer_id) find object in database by consumer_id
 * @method static \ConsumerAcl[] findByApiMethod(string $api_method) find objects in database by api_method
 * @method static \ConsumerAcl findOneByApiMethod(string $api_method) find object in database by api_method
 * @method static \ConsumerAcl[] findByAccess(integer $access) find objects in database by access
 * @method static \ConsumerAcl findOneByAccess(integer $access) find object in database by access

 */
abstract class ConsumerAclBase extends ActiveRecord {
    protected static $_tableName = 'consumer_acl';
    protected static $_pk = 'id';
    protected static $_alias = 'c';
    protected static $_dbConnectName = 'consumer_acl';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'consumer_id' => array('name' => 'consumer_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'api_method' => array('name' => 'api_method',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'access' => array('name' => 'access',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
);
    protected static $_validate = array(
        'consumer_id' => array('require' => '"consumer_id" is required!'),
        'api_method' => array('require' => '"api_method" is required!'),
        'access' => array('require' => '"access" is required!'),
);
    protected static $_cols = array('id','consumer_id','api_method','access');

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