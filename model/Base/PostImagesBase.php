<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * PostImages
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $post_id post_id type : int(11)
 * @property string $path path type : varchar(255) max_length : 255
 * @property string $caption caption type : varchar(255) max_length : 255
 * @property integer $is_main is_main type : tinyint(1)
 * @property integer $ordering ordering type : int(11)
 * @property datetime $created_time created_time type : datetime
 * @property datetime $modified_time modified_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \PostImages[] findById(integer $id) find objects in database by id
 * @method static \PostImages findOneById(integer $id) find object in database by id
 * @method static \PostImages retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setPostId(integer $post_id) set post_id value
 * @method integer getPostId() get post_id value
 * @method static \PostImages[] findByPostId(integer $post_id) find objects in database by post_id
 * @method static \PostImages findOneByPostId(integer $post_id) find object in database by post_id
 * @method static \PostImages retrieveByPostId(integer $post_id) retrieve object from poll by post_id, get it from db if not exist in poll

 * @method void setPath(string $path) set path value
 * @method string getPath() get path value
 * @method static \PostImages[] findByPath(string $path) find objects in database by path
 * @method static \PostImages findOneByPath(string $path) find object in database by path
 * @method static \PostImages retrieveByPath(string $path) retrieve object from poll by path, get it from db if not exist in poll

 * @method void setCaption(string $caption) set caption value
 * @method string getCaption() get caption value
 * @method static \PostImages[] findByCaption(string $caption) find objects in database by caption
 * @method static \PostImages findOneByCaption(string $caption) find object in database by caption
 * @method static \PostImages retrieveByCaption(string $caption) retrieve object from poll by caption, get it from db if not exist in poll

 * @method void setIsMain(integer $is_main) set is_main value
 * @method integer getIsMain() get is_main value
 * @method static \PostImages[] findByIsMain(integer $is_main) find objects in database by is_main
 * @method static \PostImages findOneByIsMain(integer $is_main) find object in database by is_main
 * @method static \PostImages retrieveByIsMain(integer $is_main) retrieve object from poll by is_main, get it from db if not exist in poll

 * @method void setOrdering(integer $ordering) set ordering value
 * @method integer getOrdering() get ordering value
 * @method static \PostImages[] findByOrdering(integer $ordering) find objects in database by ordering
 * @method static \PostImages findOneByOrdering(integer $ordering) find object in database by ordering
 * @method static \PostImages retrieveByOrdering(integer $ordering) retrieve object from poll by ordering, get it from db if not exist in poll

 * @method void setCreatedTime(\Flywheel\Db\Type\DateTime $created_time) setCreatedTime(string $created_time) set created_time value
 * @method \Flywheel\Db\Type\DateTime getCreatedTime() get created_time value
 * @method static \PostImages[] findByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \PostImages findOneByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \PostImages retrieveByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) retrieveByCreatedTime(string $created_time) retrieve object from poll by created_time, get it from db if not exist in poll

 * @method void setModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) setModifiedTime(string $modified_time) set modified_time value
 * @method \Flywheel\Db\Type\DateTime getModifiedTime() get modified_time value
 * @method static \PostImages[] findByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \PostImages findOneByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findOneByModifiedTime(string $modified_time) find object in database by modified_time
 * @method static \PostImages retrieveByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) retrieveByModifiedTime(string $modified_time) retrieve object from poll by modified_time, get it from db if not exist in poll


 */
abstract class PostImagesBase extends ActiveRecord {
    protected static $_tableName = 'post_images';
    protected static $_phpName = 'PostImages';
    protected static $_pk = 'id';
    protected static $_alias = 'p';
    protected static $_dbConnectName = 'post_images';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'post_id' => array('name' => 'post_id',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'path' => array('name' => 'path',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'caption' => array('name' => 'caption',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'is_main' => array('name' => 'is_main',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'ordering' => array('name' => 'ordering',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
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
    );
    protected static $_validatorRules = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','post_id','path','caption','is_main','ordering','created_time','modified_time');

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