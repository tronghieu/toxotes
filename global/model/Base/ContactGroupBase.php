<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * ContactGroup
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $slug slug type : varchar(255) max_length : 255

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \ContactGroup[] findById(integer $id) find objects in database by id
 * @method static \ContactGroup findOneById(integer $id) find object in database by id
 * @method static \ContactGroup retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \ContactGroup[] findByName(string $name) find objects in database by name
 * @method static \ContactGroup findOneByName(string $name) find object in database by name
 * @method static \ContactGroup retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll

 * @method void setSlug(string $slug) set slug value
 * @method string getSlug() get slug value
 * @method static \ContactGroup[] findBySlug(string $slug) find objects in database by slug
 * @method static \ContactGroup findOneBySlug(string $slug) find object in database by slug
 * @method static \ContactGroup retrieveBySlug(string $slug) retrieve object from poll by slug, get it from db if not exist in poll


 */
abstract class ContactGroupBase extends ActiveRecord {
    protected static $_tableName = 'contact_group';
    protected static $_phpName = 'ContactGroup';
    protected static $_pk = 'id';
    protected static $_alias = 'c';
    protected static $_dbConnectName = 'contact_group';
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
        'slug' => array('name' => 'slug',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
     );
    protected static $_validate = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','name','slug');

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