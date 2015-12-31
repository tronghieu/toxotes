<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * PostAttachments
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $post_id post_id type : int(11)
 * @property string $file file type : text max_length : 
 * @property string $file_name file_name type : varchar(255) max_length : 255
 * @property string $mime_type mime_type type : text max_length : 
 * @property string $type_group type_group type : varchar(100) max_length : 100
 * @property integer $hits hits type : int(11)
 * @property datetime $uploaded_time uploaded_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \PostAttachments[] findById(integer $id) find objects in database by id
 * @method static \PostAttachments findOneById(integer $id) find object in database by id
 * @method static \PostAttachments retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setPostId(integer $post_id) set post_id value
 * @method integer getPostId() get post_id value
 * @method static \PostAttachments[] findByPostId(integer $post_id) find objects in database by post_id
 * @method static \PostAttachments findOneByPostId(integer $post_id) find object in database by post_id
 * @method static \PostAttachments retrieveByPostId(integer $post_id) retrieve object from poll by post_id, get it from db if not exist in poll

 * @method void setFile(string $file) set file value
 * @method string getFile() get file value
 * @method static \PostAttachments[] findByFile(string $file) find objects in database by file
 * @method static \PostAttachments findOneByFile(string $file) find object in database by file
 * @method static \PostAttachments retrieveByFile(string $file) retrieve object from poll by file, get it from db if not exist in poll

 * @method void setFileName(string $file_name) set file_name value
 * @method string getFileName() get file_name value
 * @method static \PostAttachments[] findByFileName(string $file_name) find objects in database by file_name
 * @method static \PostAttachments findOneByFileName(string $file_name) find object in database by file_name
 * @method static \PostAttachments retrieveByFileName(string $file_name) retrieve object from poll by file_name, get it from db if not exist in poll

 * @method void setMimeType(string $mime_type) set mime_type value
 * @method string getMimeType() get mime_type value
 * @method static \PostAttachments[] findByMimeType(string $mime_type) find objects in database by mime_type
 * @method static \PostAttachments findOneByMimeType(string $mime_type) find object in database by mime_type
 * @method static \PostAttachments retrieveByMimeType(string $mime_type) retrieve object from poll by mime_type, get it from db if not exist in poll

 * @method void setTypeGroup(string $type_group) set type_group value
 * @method string getTypeGroup() get type_group value
 * @method static \PostAttachments[] findByTypeGroup(string $type_group) find objects in database by type_group
 * @method static \PostAttachments findOneByTypeGroup(string $type_group) find object in database by type_group
 * @method static \PostAttachments retrieveByTypeGroup(string $type_group) retrieve object from poll by type_group, get it from db if not exist in poll

 * @method void setHits(integer $hits) set hits value
 * @method integer getHits() get hits value
 * @method static \PostAttachments[] findByHits(integer $hits) find objects in database by hits
 * @method static \PostAttachments findOneByHits(integer $hits) find object in database by hits
 * @method static \PostAttachments retrieveByHits(integer $hits) retrieve object from poll by hits, get it from db if not exist in poll

 * @method void setUploadedTime(\Flywheel\Db\Type\DateTime $uploaded_time) setUploadedTime(string $uploaded_time) set uploaded_time value
 * @method \Flywheel\Db\Type\DateTime getUploadedTime() get uploaded_time value
 * @method static \PostAttachments[] findByUploadedTime(\Flywheel\Db\Type\DateTime $uploaded_time) findByUploadedTime(string $uploaded_time) find objects in database by uploaded_time
 * @method static \PostAttachments findOneByUploadedTime(\Flywheel\Db\Type\DateTime $uploaded_time) findOneByUploadedTime(string $uploaded_time) find object in database by uploaded_time
 * @method static \PostAttachments retrieveByUploadedTime(\Flywheel\Db\Type\DateTime $uploaded_time) retrieveByUploadedTime(string $uploaded_time) retrieve object from poll by uploaded_time, get it from db if not exist in poll


 */
abstract class PostAttachmentsBase extends ActiveRecord {
    protected static $_tableName = 'post_attachments';
    protected static $_phpName = 'PostAttachments';
    protected static $_pk = 'id';
    protected static $_alias = 'p';
    protected static $_dbConnectName = 'post_attachments';
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
        'file' => array('name' => 'file',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'file_name' => array('name' => 'file_name',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'mime_type' => array('name' => 'mime_type',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'type_group' => array('name' => 'type_group',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'hits' => array('name' => 'hits',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'uploaded_time' => array('name' => 'uploaded_time',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
     );
    protected static $_validate = array(
    );
    protected static $_validatorRules = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','post_id','file','file_name','mime_type','type_group','hits','uploaded_time');

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