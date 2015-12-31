<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Extension
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $author author type : varchar(255) max_length : 255
 * @property string $author_email author_email type : varchar(255) max_length : 255
 * @property string $description description type : varchar(255) max_length : 255
 * @property string $type type type : enum('PLUGIN','MODULE') max_length : 6
 * @property string $path path type : varchar(255) max_length : 255
 * @property integer $status status type : tinyint(1)
 * @property datetime $created_time created_time type : datetime
 * @property datetime $modified_time modified_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Extension[] findById(integer $id) find objects in database by id
 * @method static \Extension findOneById(integer $id) find object in database by id
 * @method static \Extension retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \Extension[] findByName(string $name) find objects in database by name
 * @method static \Extension findOneByName(string $name) find object in database by name
 * @method static \Extension retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll

 * @method void setAuthor(string $author) set author value
 * @method string getAuthor() get author value
 * @method static \Extension[] findByAuthor(string $author) find objects in database by author
 * @method static \Extension findOneByAuthor(string $author) find object in database by author
 * @method static \Extension retrieveByAuthor(string $author) retrieve object from poll by author, get it from db if not exist in poll

 * @method void setAuthorEmail(string $author_email) set author_email value
 * @method string getAuthorEmail() get author_email value
 * @method static \Extension[] findByAuthorEmail(string $author_email) find objects in database by author_email
 * @method static \Extension findOneByAuthorEmail(string $author_email) find object in database by author_email
 * @method static \Extension retrieveByAuthorEmail(string $author_email) retrieve object from poll by author_email, get it from db if not exist in poll

 * @method void setDescription(string $description) set description value
 * @method string getDescription() get description value
 * @method static \Extension[] findByDescription(string $description) find objects in database by description
 * @method static \Extension findOneByDescription(string $description) find object in database by description
 * @method static \Extension retrieveByDescription(string $description) retrieve object from poll by description, get it from db if not exist in poll

 * @method void setType(string $type) set type value
 * @method string getType() get type value
 * @method static \Extension[] findByType(string $type) find objects in database by type
 * @method static \Extension findOneByType(string $type) find object in database by type
 * @method static \Extension retrieveByType(string $type) retrieve object from poll by type, get it from db if not exist in poll

 * @method void setPath(string $path) set path value
 * @method string getPath() get path value
 * @method static \Extension[] findByPath(string $path) find objects in database by path
 * @method static \Extension findOneByPath(string $path) find object in database by path
 * @method static \Extension retrieveByPath(string $path) retrieve object from poll by path, get it from db if not exist in poll

 * @method void setStatus(integer $status) set status value
 * @method integer getStatus() get status value
 * @method static \Extension[] findByStatus(integer $status) find objects in database by status
 * @method static \Extension findOneByStatus(integer $status) find object in database by status
 * @method static \Extension retrieveByStatus(integer $status) retrieve object from poll by status, get it from db if not exist in poll

 * @method void setCreatedTime(\Flywheel\Db\Type\DateTime $created_time) setCreatedTime(string $created_time) set created_time value
 * @method \Flywheel\Db\Type\DateTime getCreatedTime() get created_time value
 * @method static \Extension[] findByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \Extension findOneByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \Extension retrieveByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) retrieveByCreatedTime(string $created_time) retrieve object from poll by created_time, get it from db if not exist in poll

 * @method void setModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) setModifiedTime(string $modified_time) set modified_time value
 * @method \Flywheel\Db\Type\DateTime getModifiedTime() get modified_time value
 * @method static \Extension[] findByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \Extension findOneByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findOneByModifiedTime(string $modified_time) find object in database by modified_time
 * @method static \Extension retrieveByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) retrieveByModifiedTime(string $modified_time) retrieve object from poll by modified_time, get it from db if not exist in poll


 */
abstract class ExtensionBase extends ActiveRecord {
    protected static $_tableName = 'extension';
    protected static $_phpName = 'Extension';
    protected static $_pk = 'id';
    protected static $_alias = 'e';
    protected static $_dbConnectName = 'extension';
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
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'author' => array('name' => 'author',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'author_email' => array('name' => 'author_email',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'description' => array('name' => 'description',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'type' => array('name' => 'type',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'enum(\'PLUGIN\',\'MODULE\')',
                'length' => 6),
        'path' => array('name' => 'path',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'status' => array('name' => 'status',
                'default' => 1,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'created_time' => array('name' => 'created_time',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'modified_time' => array('name' => 'modified_time',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
     );
    protected static $_validate = array(
        'type' => array(
            array('name' => 'ValidValues',
                'value' => 'PLUGIN|MODULE',
                'message'=> 'type\'s values is not allowed'
            ),
        ),
    );
    protected static $_validatorRules = array(
        'type' => array(
            array('name' => 'ValidValues',
                'value' => 'PLUGIN|MODULE',
                'message'=> 'type\'s values is not allowed'
            ),
        ),
    );
    protected static $_init = false;
    protected static $_cols = array('id','name','author','author_email','description','type','path','status','created_time','modified_time');

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