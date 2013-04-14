<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Consumer
 *  This class has been auto-generated at 03/04/2013 14:50:59
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $key key type : char(26) max_length : 26
 * @property string $secret secret type : char(56) max_length : 56
 * @property string $allowed_ips allowed_ips type : varchar(255) max_length : 255
 * @property string $desc desc type : text max_length : 
 * @property integer $status status type : tinyint(1)
 * @property string $public_key public_key type : text max_length : 

 * @method static \Consumer[] findById(integer $id) find objects in database by id
 * @method static \Consumer findOneById(integer $id) find object in database by id
 * @method static \Consumer[] findByName(string $name) find objects in database by name
 * @method static \Consumer findOneByName(string $name) find object in database by name
 * @method static \Consumer[] findByKey(string $key) find objects in database by key
 * @method static \Consumer findOneByKey(string $key) find object in database by key
 * @method static \Consumer[] findBySecret(string $secret) find objects in database by secret
 * @method static \Consumer findOneBySecret(string $secret) find object in database by secret
 * @method static \Consumer[] findByAllowedIps(string $allowed_ips) find objects in database by allowed_ips
 * @method static \Consumer findOneByAllowedIps(string $allowed_ips) find object in database by allowed_ips
 * @method static \Consumer[] findByDesc(string $desc) find objects in database by desc
 * @method static \Consumer findOneByDesc(string $desc) find object in database by desc
 * @method static \Consumer[] findByStatus(integer $status) find objects in database by status
 * @method static \Consumer findOneByStatus(integer $status) find object in database by status
 * @method static \Consumer[] findByPublicKey(string $public_key) find objects in database by public_key
 * @method static \Consumer findOneByPublicKey(string $public_key) find object in database by public_key

 */
abstract class ConsumerBase extends ActiveRecord {
    protected static $_tableName = 'consumer';
    protected static $_pk = 'id';
    protected static $_alias = 'c';
    protected static $_dbConnectName = 'consumer';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'name' => array('name' => 'name',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'key' => array('name' => 'key',
                'type' => 'string',
                'db_type' => 'char(26)',
                'length' => 26),
        'secret' => array('name' => 'secret',
                'type' => 'string',
                'db_type' => 'char(56)',
                'length' => 56),
        'allowed_ips' => array('name' => 'allowed_ips',
                'default' => '*',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'desc' => array('name' => 'desc',
                'type' => 'string',
                'db_type' => 'text'),
        'status' => array('name' => 'status',
                'default' => 1,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'public_key' => array('name' => 'public_key',
                'type' => 'string',
                'db_type' => 'text'),
);
    protected static $_validate = array(
        'name' => array('require' => '"name" is required!'),
        'key' => array('require' => '"key" is required!',
                'unique' => 'key\'s values has already been taken'),
        'secret' => array('require' => '"secret" is required!'),
        'allowed_ips' => array('require' => '"allowed_ips" is required!'),
        'status' => array('require' => '"status" is required!'),
        'public_key' => array('require' => '"public_key" is required!'),
);
    protected static $_cols = array('id','name','key','secret','allowed_ips','desc','status','public_key');

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