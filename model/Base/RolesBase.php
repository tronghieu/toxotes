<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Roles
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $name name type : varchar(255) max_length : 255
 * @property integer $member_no member_no type : int(11)
 * @property string $status status type : enum('ACTIVE','INACTIVE') max_length : 8
 * @property integer $lvl lvl type : int(11)
 * @property integer $lft lft type : int(11)
 * @property integer $rgt rgt type : int(11)
 * @property string $description description type : mediumtext max_length : 
 * @property integer $parent_id parent_id type : int(11)
 * @property string $scope_id scope_id type : varchar(100) max_length : 100
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

 * @method void setMemberNo(integer $member_no) set member_no value
 * @method integer getMemberNo() get member_no value
 * @method static \Roles[] findByMemberNo(integer $member_no) find objects in database by member_no
 * @method static \Roles findOneByMemberNo(integer $member_no) find object in database by member_no
 * @method static \Roles retrieveByMemberNo(integer $member_no) retrieve object from poll by member_no, get it from db if not exist in poll

 * @method void setStatus(string $status) set status value
 * @method string getStatus() get status value
 * @method static \Roles[] findByStatus(string $status) find objects in database by status
 * @method static \Roles findOneByStatus(string $status) find object in database by status
 * @method static \Roles retrieveByStatus(string $status) retrieve object from poll by status, get it from db if not exist in poll

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

 * @method void setDescription(string $description) set description value
 * @method string getDescription() get description value
 * @method static \Roles[] findByDescription(string $description) find objects in database by description
 * @method static \Roles findOneByDescription(string $description) find object in database by description
 * @method static \Roles retrieveByDescription(string $description) retrieve object from poll by description, get it from db if not exist in poll

 * @method void setParentId(integer $parent_id) set parent_id value
 * @method integer getParentId() get parent_id value
 * @method static \Roles[] findByParentId(integer $parent_id) find objects in database by parent_id
 * @method static \Roles findOneByParentId(integer $parent_id) find object in database by parent_id
 * @method static \Roles retrieveByParentId(integer $parent_id) retrieve object from poll by parent_id, get it from db if not exist in poll

 * @method void setScopeId(string $scope_id) set scope_id value
 * @method string getScopeId() get scope_id value
 * @method static \Roles[] findByScopeId(string $scope_id) find objects in database by scope_id
 * @method static \Roles findOneByScopeId(string $scope_id) find object in database by scope_id
 * @method static \Roles retrieveByScopeId(string $scope_id) retrieve object from poll by scope_id, get it from db if not exist in poll

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
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'name' => array('name' => 'name',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'member_no' => array('name' => 'member_no',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'status' => array('name' => 'status',
                'default' => 'ACTIVE',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'ACTIVE\',\'INACTIVE\')',
                'length' => 8),
        'lvl' => array('name' => 'lvl',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'lft' => array('name' => 'lft',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'rgt' => array('name' => 'rgt',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'description' => array('name' => 'description',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'mediumtext'),
        'parent_id' => array('name' => 'parent_id',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'scope_id' => array('name' => 'scope_id',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'admin_access' => array('name' => 'admin_access',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
     );
    protected static $_validate = array(
        'status' => array(
            array('name' => 'ValidValues',
                'value' => 'ACTIVE|INACTIVE',
                'message'=> 'status\'s values is not allowed'
            ),
        ),
    );
    protected static $_validatorRules = array(
        'status' => array(
            array('name' => 'ValidValues',
                'value' => 'ACTIVE|INACTIVE',
                'message'=> 'status\'s values is not allowed'
            ),
        ),
    );
    protected static $_init = false;
    protected static $_cols = array('id','name','member_no','status','lvl','lft','rgt','description','parent_id','scope_id','admin_access');

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