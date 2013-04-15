<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Roles
 *  This class has been auto-generated at 15/04/2013 11:54:17
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $name name type : varchar(255) max_length : 255
 * @property integer $lvl lvl type : int(11)
 * @property integer $lft lft type : int(11)
 * @property integer $rgt rgt type : int(11)
 * @property integer $scope_id scope_id type : int(11)
 * @property integer $admin_access admin_access type : tinyint(1)

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Roles[] findById(integer $id) find objects in database by id
 * @method static \Roles findOneById(integer $id) find object in database by id
 * @method static \Roles retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll
 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \Roles[] findByName(string $name) find objects in database by name
 * @method static \Roles findOneByName(string $name) find object in database by name
 * @method static \Roles retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll
 * @method void setLvl(integer $lvl) set lvl value
 * @method integer getLvl() get lvl value
 * @method static \Roles[] findByLvl(integer $lvl) find objects in database by lvl
 * @method static \Roles findOneByLvl(integer $lvl) find object in database by lvl
 * @method static \Roles retrieveByLvl(integer $lvl) retrieve object from poll by lvl, get it from db if not exist in poll
 * @method void setLft(integer $lft) set lft value
 * @method integer getLft() get lft value
 * @method static \Roles[] findByLft(integer $lft) find objects in database by lft
 * @method static \Roles findOneByLft(integer $lft) find object in database by lft
 * @method static \Roles retrieveByLft(integer $lft) retrieve object from poll by lft, get it from db if not exist in poll
 * @method void setRgt(integer $rgt) set rgt value
 * @method integer getRgt() get rgt value
 * @method static \Roles[] findByRgt(integer $rgt) find objects in database by rgt
 * @method static \Roles findOneByRgt(integer $rgt) find object in database by rgt
 * @method static \Roles retrieveByRgt(integer $rgt) retrieve object from poll by rgt, get it from db if not exist in poll
 * @method void setScopeId(integer $scope_id) set scope_id value
 * @method integer getScopeId() get scope_id value
 * @method static \Roles[] findByScopeId(integer $scope_id) find objects in database by scope_id
 * @method static \Roles findOneByScopeId(integer $scope_id) find object in database by scope_id
 * @method static \Roles retrieveByScopeId(integer $scope_id) retrieve object from poll by scope_id, get it from db if not exist in poll
 * @method void setAdminAccess(integer $admin_access) set admin_access value
 * @method integer getAdminAccess() get admin_access value
 * @method static \Roles[] findByAdminAccess(integer $admin_access) find objects in database by admin_access
 * @method static \Roles findOneByAdminAccess(integer $admin_access) find object in database by admin_access
 * @method static \Roles retrieveByAdminAccess(integer $admin_access) retrieve object from poll by admin_access, get it from db if not exist in poll

 */
abstract class RolesBase extends ActiveRecord {
    protected static $_tableName = 'roles';
    protected static $_phpName = 'Roles';
    protected static $_pk = 'id';
    protected static $_alias = 'r';
    protected static $_dbConnectName = 'roles';
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
        'lvl' => array('name' => 'lvl',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'lft' => array('name' => 'lft',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'rgt' => array('name' => 'rgt',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'scope_id' => array('name' => 'scope_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'admin_access' => array('name' => 'admin_access',
                'default' => 0,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
);
    protected static $_validate = array(
        'lvl' => array('require' => '"lvl" is required!'),
        'lft' => array('require' => '"lft" is required!'),
        'rgt' => array('require' => '"rgt" is required!'),
        'admin_access' => array('require' => '"admin_access" is required!'),
);
    protected static $_cols = array('id','name','lvl','lft','rgt','scope_id','admin_access');

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
            self::addInstanceToPool($this, $this->{$this->getPkValue()});
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
            self::removeInstanceFromPool($this->{$this->getPkValue()});
            return true;
        }
        catch (\Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }
}