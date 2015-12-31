<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Menus
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $alias alias type : varchar(255) max_length : 255
 * @property string $type type type : varchar(10) max_length : 10
 * @property string $route route type : varchar(20) max_length : 20
 * @property string $route_param route_param type : text max_length : 
 * @property string $description description type : text max_length : 
 * @property string $link link type : text max_length : 
 * @property string $target target type : varchar(10) max_length : 10
 * @property string $object object type : varchar(255) max_length : 255
 * @property string $extra_param extra_param type : text max_length : 
 * @property integer $status status type : tinyint(1)
 * @property string $language language type : varchar(10) max_length : 10
 * @property integer $lvl lvl type : int(11)
 * @property integer $lft lft type : int(11)
 * @property integer $rgt rgt type : int(11)

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Menus[] findById(integer $id) find objects in database by id
 * @method static \Menus findOneById(integer $id) find object in database by id
 * @method static \Menus retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \Menus[] findByName(string $name) find objects in database by name
 * @method static \Menus findOneByName(string $name) find object in database by name
 * @method static \Menus retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll

 * @method void setAlias(string $alias) set alias value
 * @method string getAlias() get alias value
 * @method static \Menus[] findByAlias(string $alias) find objects in database by alias
 * @method static \Menus findOneByAlias(string $alias) find object in database by alias
 * @method static \Menus retrieveByAlias(string $alias) retrieve object from poll by alias, get it from db if not exist in poll

 * @method void setType(string $type) set type value
 * @method string getType() get type value
 * @method static \Menus[] findByType(string $type) find objects in database by type
 * @method static \Menus findOneByType(string $type) find object in database by type
 * @method static \Menus retrieveByType(string $type) retrieve object from poll by type, get it from db if not exist in poll

 * @method void setRoute(string $route) set route value
 * @method string getRoute() get route value
 * @method static \Menus[] findByRoute(string $route) find objects in database by route
 * @method static \Menus findOneByRoute(string $route) find object in database by route
 * @method static \Menus retrieveByRoute(string $route) retrieve object from poll by route, get it from db if not exist in poll

 * @method void setRouteParam(string $route_param) set route_param value
 * @method string getRouteParam() get route_param value
 * @method static \Menus[] findByRouteParam(string $route_param) find objects in database by route_param
 * @method static \Menus findOneByRouteParam(string $route_param) find object in database by route_param
 * @method static \Menus retrieveByRouteParam(string $route_param) retrieve object from poll by route_param, get it from db if not exist in poll

 * @method void setDescription(string $description) set description value
 * @method string getDescription() get description value
 * @method static \Menus[] findByDescription(string $description) find objects in database by description
 * @method static \Menus findOneByDescription(string $description) find object in database by description
 * @method static \Menus retrieveByDescription(string $description) retrieve object from poll by description, get it from db if not exist in poll

 * @method void setLink(string $link) set link value
 * @method string getLink() get link value
 * @method static \Menus[] findByLink(string $link) find objects in database by link
 * @method static \Menus findOneByLink(string $link) find object in database by link
 * @method static \Menus retrieveByLink(string $link) retrieve object from poll by link, get it from db if not exist in poll

 * @method void setTarget(string $target) set target value
 * @method string getTarget() get target value
 * @method static \Menus[] findByTarget(string $target) find objects in database by target
 * @method static \Menus findOneByTarget(string $target) find object in database by target
 * @method static \Menus retrieveByTarget(string $target) retrieve object from poll by target, get it from db if not exist in poll

 * @method void setObject(string $object) set object value
 * @method string getObject() get object value
 * @method static \Menus[] findByObject(string $object) find objects in database by object
 * @method static \Menus findOneByObject(string $object) find object in database by object
 * @method static \Menus retrieveByObject(string $object) retrieve object from poll by object, get it from db if not exist in poll

 * @method void setExtraParam(string $extra_param) set extra_param value
 * @method string getExtraParam() get extra_param value
 * @method static \Menus[] findByExtraParam(string $extra_param) find objects in database by extra_param
 * @method static \Menus findOneByExtraParam(string $extra_param) find object in database by extra_param
 * @method static \Menus retrieveByExtraParam(string $extra_param) retrieve object from poll by extra_param, get it from db if not exist in poll

 * @method void setStatus(integer $status) set status value
 * @method integer getStatus() get status value
 * @method static \Menus[] findByStatus(integer $status) find objects in database by status
 * @method static \Menus findOneByStatus(integer $status) find object in database by status
 * @method static \Menus retrieveByStatus(integer $status) retrieve object from poll by status, get it from db if not exist in poll

 * @method void setLanguage(string $language) set language value
 * @method string getLanguage() get language value
 * @method static \Menus[] findByLanguage(string $language) find objects in database by language
 * @method static \Menus findOneByLanguage(string $language) find object in database by language
 * @method static \Menus retrieveByLanguage(string $language) retrieve object from poll by language, get it from db if not exist in poll

 * @method void setLvl(integer $lvl) set lvl value
 * @method integer getLvl() get lvl value
 * @method static \Menus[] findByLvl(integer $lvl) find objects in database by lvl
 * @method static \Menus findOneByLvl(integer $lvl) find object in database by lvl
 * @method static \Menus retrieveByLvl(integer $lvl) retrieve object from poll by lvl, get it from db if not exist in poll

 * @method void setLft(integer $lft) set lft value
 * @method integer getLft() get lft value
 * @method static \Menus[] findByLft(integer $lft) find objects in database by lft
 * @method static \Menus findOneByLft(integer $lft) find object in database by lft
 * @method static \Menus retrieveByLft(integer $lft) retrieve object from poll by lft, get it from db if not exist in poll

 * @method void setRgt(integer $rgt) set rgt value
 * @method integer getRgt() get rgt value
 * @method static \Menus[] findByRgt(integer $rgt) find objects in database by rgt
 * @method static \Menus findOneByRgt(integer $rgt) find object in database by rgt
 * @method static \Menus retrieveByRgt(integer $rgt) retrieve object from poll by rgt, get it from db if not exist in poll


 */
abstract class MenusBase extends ActiveRecord {
    protected static $_tableName = 'menus';
    protected static $_phpName = 'Menus';
    protected static $_pk = 'id';
    protected static $_alias = 'm';
    protected static $_dbConnectName = 'menus';
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
        'alias' => array('name' => 'alias',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'type' => array('name' => 'type',
                'default' => 'internal',
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
        'description' => array('name' => 'description',
                'not_null' => false,
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
        'language' => array('name' => 'language',
                'default' => '*',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(10)',
                'length' => 10),
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
    protected static $_validatorRules = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','name','alias','type','route','route_param','description','link','target','object','extra_param','status','language','lvl','lft','rgt');

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