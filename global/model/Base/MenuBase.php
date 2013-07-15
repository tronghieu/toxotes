<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Menu
 *  This class has been auto-generated at 15/07/2013 18:38:39
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $type type type : varchar(10) max_length : 10
 * @property string $route route type : varchar(20) max_length : 20
 * @property string $route_param route_param type : text max_length : 
 * @property string $link link type : text max_length : 
 * @property string $target target type : varchar(10) max_length : 10
 * @property string $object object type : varchar(255) max_length : 255
 * @property string $extra_param extra_param type : text max_length : 
 * @property integer $status status type : tinyint(1)
 * @property integer $lvl lvl type : int(11)
 * @property integer $lft lft type : int(11)
 * @property integer $rgt rgt type : int(11)

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Menu[] findById(integer $id) find objects in database by id
 * @method static \Menu findOneById(integer $id) find object in database by id
 * @method static \Menu retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \Menu[] findByName(string $name) find objects in database by name
 * @method static \Menu findOneByName(string $name) find object in database by name
 * @method static \Menu retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll

 * @method void setType(string $type) set type value
 * @method string getType() get type value
 * @method static \Menu[] findByType(string $type) find objects in database by type
 * @method static \Menu findOneByType(string $type) find object in database by type
 * @method static \Menu retrieveByType(string $type) retrieve object from poll by type, get it from db if not exist in poll

 * @method void setRoute(string $route) set route value
 * @method string getRoute() get route value
 * @method static \Menu[] findByRoute(string $route) find objects in database by route
 * @method static \Menu findOneByRoute(string $route) find object in database by route
 * @method static \Menu retrieveByRoute(string $route) retrieve object from poll by route, get it from db if not exist in poll

 * @method void setRouteParam(string $route_param) set route_param value
 * @method string getRouteParam() get route_param value
 * @method static \Menu[] findByRouteParam(string $route_param) find objects in database by route_param
 * @method static \Menu findOneByRouteParam(string $route_param) find object in database by route_param
 * @method static \Menu retrieveByRouteParam(string $route_param) retrieve object from poll by route_param, get it from db if not exist in poll

 * @method void setLink(string $link) set link value
 * @method string getLink() get link value
 * @method static \Menu[] findByLink(string $link) find objects in database by link
 * @method static \Menu findOneByLink(string $link) find object in database by link
 * @method static \Menu retrieveByLink(string $link) retrieve object from poll by link, get it from db if not exist in poll

 * @method void setTarget(string $target) set target value
 * @method string getTarget() get target value
 * @method static \Menu[] findByTarget(string $target) find objects in database by target
 * @method static \Menu findOneByTarget(string $target) find object in database by target
 * @method static \Menu retrieveByTarget(string $target) retrieve object from poll by target, get it from db if not exist in poll

 * @method void setObject(string $object) set object value
 * @method string getObject() get object value
 * @method static \Menu[] findByObject(string $object) find objects in database by object
 * @method static \Menu findOneByObject(string $object) find object in database by object
 * @method static \Menu retrieveByObject(string $object) retrieve object from poll by object, get it from db if not exist in poll

 * @method void setExtraParam(string $extra_param) set extra_param value
 * @method string getExtraParam() get extra_param value
 * @method static \Menu[] findByExtraParam(string $extra_param) find objects in database by extra_param
 * @method static \Menu findOneByExtraParam(string $extra_param) find object in database by extra_param
 * @method static \Menu retrieveByExtraParam(string $extra_param) retrieve object from poll by extra_param, get it from db if not exist in poll

 * @method void setStatus(integer $status) set status value
 * @method integer getStatus() get status value
 * @method static \Menu[] findByStatus(integer $status) find objects in database by status
 * @method static \Menu findOneByStatus(integer $status) find object in database by status
 * @method static \Menu retrieveByStatus(integer $status) retrieve object from poll by status, get it from db if not exist in poll

 * @method void setLvl(integer $lvl) set lvl value
 * @method integer getLvl() get lvl value
 * @method static \Menu[] findByLvl(integer $lvl) find objects in database by lvl
 * @method static \Menu findOneByLvl(integer $lvl) find object in database by lvl
 * @method static \Menu retrieveByLvl(integer $lvl) retrieve object from poll by lvl, get it from db if not exist in poll

 * @method void setLft(integer $lft) set lft value
 * @method integer getLft() get lft value
 * @method static \Menu[] findByLft(integer $lft) find objects in database by lft
 * @method static \Menu findOneByLft(integer $lft) find object in database by lft
 * @method static \Menu retrieveByLft(integer $lft) retrieve object from poll by lft, get it from db if not exist in poll

 * @method void setRgt(integer $rgt) set rgt value
 * @method integer getRgt() get rgt value
 * @method static \Menu[] findByRgt(integer $rgt) find objects in database by rgt
 * @method static \Menu findOneByRgt(integer $rgt) find object in database by rgt
 * @method static \Menu retrieveByRgt(integer $rgt) retrieve object from poll by rgt, get it from db if not exist in poll


 */
abstract class MenuBase extends ActiveRecord {
    protected static $_tableName = 'menu';
    protected static $_phpName = 'Menu';
    protected static $_pk = 'id';
    protected static $_alias = 'm';
    protected static $_dbConnectName = 'menu';
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
        'type' => array('name' => 'type',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(10)',
                'length' => 10),
        'route' => array('name' => 'route',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(20)',
                'length' => 20),
        'route_param' => array('name' => 'route_param',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'link' => array('name' => 'link',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'target' => array('name' => 'target',
                'default' => '_self',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(10)',
                'length' => 10),
        'object' => array('name' => 'object',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'extra_param' => array('name' => 'extra_param',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'status' => array('name' => 'status',
                'default' => 1,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
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
     );
    protected static $_validate = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','name','type','route','route_param','link','target','object','extra_param','status','lvl','lft','rgt');

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