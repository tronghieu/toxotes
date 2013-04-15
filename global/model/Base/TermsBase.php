<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Terms
 *  This class has been auto-generated at 15/04/2013 11:54:17
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $slug slug type : varchar(255) max_length : 255
 * @property string $taxonomy taxonomy type : varchar(100) max_length : 100
 * @property string $description description type : text max_length : 
 * @property integer $count count type : int(11)
 * @property string $scope scope type : varchar(100) max_length : 100
 * @property integer $lft lft type : int(11)
 * @property integer $rgt rgt type : int(11)
 * @property integer $lvl lvl type : int(11)

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Terms[] findById(integer $id) find objects in database by id
 * @method static \Terms findOneById(integer $id) find object in database by id
 * @method static \Terms retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll
 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \Terms[] findByName(string $name) find objects in database by name
 * @method static \Terms findOneByName(string $name) find object in database by name
 * @method static \Terms retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll
 * @method void setSlug(string $slug) set slug value
 * @method string getSlug() get slug value
 * @method static \Terms[] findBySlug(string $slug) find objects in database by slug
 * @method static \Terms findOneBySlug(string $slug) find object in database by slug
 * @method static \Terms retrieveBySlug(string $slug) retrieve object from poll by slug, get it from db if not exist in poll
 * @method void setTaxonomy(string $taxonomy) set taxonomy value
 * @method string getTaxonomy() get taxonomy value
 * @method static \Terms[] findByTaxonomy(string $taxonomy) find objects in database by taxonomy
 * @method static \Terms findOneByTaxonomy(string $taxonomy) find object in database by taxonomy
 * @method static \Terms retrieveByTaxonomy(string $taxonomy) retrieve object from poll by taxonomy, get it from db if not exist in poll
 * @method void setDescription(string $description) set description value
 * @method string getDescription() get description value
 * @method static \Terms[] findByDescription(string $description) find objects in database by description
 * @method static \Terms findOneByDescription(string $description) find object in database by description
 * @method static \Terms retrieveByDescription(string $description) retrieve object from poll by description, get it from db if not exist in poll
 * @method void setCount(integer $count) set count value
 * @method integer getCount() get count value
 * @method static \Terms[] findByCount(integer $count) find objects in database by count
 * @method static \Terms findOneByCount(integer $count) find object in database by count
 * @method static \Terms retrieveByCount(integer $count) retrieve object from poll by count, get it from db if not exist in poll
 * @method void setScope(string $scope) set scope value
 * @method string getScope() get scope value
 * @method static \Terms[] findByScope(string $scope) find objects in database by scope
 * @method static \Terms findOneByScope(string $scope) find object in database by scope
 * @method static \Terms retrieveByScope(string $scope) retrieve object from poll by scope, get it from db if not exist in poll
 * @method void setLft(integer $lft) set lft value
 * @method integer getLft() get lft value
 * @method static \Terms[] findByLft(integer $lft) find objects in database by lft
 * @method static \Terms findOneByLft(integer $lft) find object in database by lft
 * @method static \Terms retrieveByLft(integer $lft) retrieve object from poll by lft, get it from db if not exist in poll
 * @method void setRgt(integer $rgt) set rgt value
 * @method integer getRgt() get rgt value
 * @method static \Terms[] findByRgt(integer $rgt) find objects in database by rgt
 * @method static \Terms findOneByRgt(integer $rgt) find object in database by rgt
 * @method static \Terms retrieveByRgt(integer $rgt) retrieve object from poll by rgt, get it from db if not exist in poll
 * @method void setLvl(integer $lvl) set lvl value
 * @method integer getLvl() get lvl value
 * @method static \Terms[] findByLvl(integer $lvl) find objects in database by lvl
 * @method static \Terms findOneByLvl(integer $lvl) find object in database by lvl
 * @method static \Terms retrieveByLvl(integer $lvl) retrieve object from poll by lvl, get it from db if not exist in poll

 */
abstract class TermsBase extends ActiveRecord {
    protected static $_tableName = 'terms';
    protected static $_phpName = 'Terms';
    protected static $_pk = 'id';
    protected static $_alias = 't';
    protected static $_dbConnectName = 'terms';
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
        'slug' => array('name' => 'slug',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'taxonomy' => array('name' => 'taxonomy',
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'description' => array('name' => 'description',
                'type' => 'string',
                'db_type' => 'text'),
        'count' => array('name' => 'count',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'scope' => array('name' => 'scope',
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
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
        'lvl' => array('name' => 'lvl',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
);
    protected static $_validate = array(
        'name' => array('require' => '"name" is required!'),
        'taxonomy' => array('require' => '"taxonomy" is required!'),
        'count' => array('require' => '"count" is required!'),
        'scope' => array('require' => '"scope" is required!'),
        'lft' => array('require' => '"lft" is required!'),
        'rgt' => array('require' => '"rgt" is required!'),
        'lvl' => array('require' => '"lvl" is required!'),
);
    protected static $_cols = array('id','name','slug','taxonomy','description','count','scope','lft','rgt','lvl');

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