<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * UserRole
 * @version		$Id$
 * @package		Model

 * @property integer $user_id user_id primary type : int(11) unsigned
 * @property integer $role_id role_id primary type : int(11) unsigned

 * @method void setUserId(integer $user_id) set user_id value
 * @method integer getUserId() get user_id value
 * @method static \UserRole[] findByUserId(integer $user_id) find objects in database by user_id
 * @method static \UserRole findOneByUserId(integer $user_id) find object in database by user_id
 * @method static \UserRole retrieveByUserId(integer $user_id) retrieve object from poll by user_id, get it from db if not exist in poll

 * @method void setRoleId(integer $role_id) set role_id value
 * @method integer getRoleId() get role_id value
 * @method static \UserRole[] findByRoleId(integer $role_id) find objects in database by role_id
 * @method static \UserRole findOneByRoleId(integer $role_id) find object in database by role_id
 * @method static \UserRole retrieveByRoleId(integer $role_id) retrieve object from poll by role_id, get it from db if not exist in poll


 */
abstract class UserRoleBase extends ActiveRecord {
    protected static $_tableName = 'user_role';
    protected static $_phpName = 'UserRole';
    protected static $_pk = 'role_id';
    protected static $_alias = 'u';
    protected static $_dbConnectName = 'user_role';
    protected static $_instances = array();
    protected static $_schema = array(
        'user_id' => array('name' => 'user_id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => false,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'role_id' => array('name' => 'role_id',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => false,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
     );
    protected static $_validate = array(
    );
    protected static $_validatorRules = array(
    );
    protected static $_init = false;
    protected static $_cols = array('user_id','role_id');

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