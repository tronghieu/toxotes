<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Banner
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $term_id term_id type : int(11)
 * @property string $file file type : varchar(255) max_length : 255
 * @property string $title title type : varchar(255) max_length : 255
 * @property integer $ordering ordering type : int(11)
 * @property string $img_alt img_alt type : varchar(255) max_length : 255
 * @property string $link link type : varchar(255) max_length : 255
 * @property string $link_target link_target type : varchar(10) max_length : 10
 * @property integer $auto_size auto_size type : tinyint(1)
 * @property integer $width width type : int(11)
 * @property integer $height height type : int(11)
 * @property string $wrapper_id wrapper_id type : varchar(255) max_length : 255
 * @property string $wrapper_class wrapper_class type : varchar(255) max_length : 255
 * @property string $is_visible is_visible type : varchar(255) max_length : 255
 * @property string $language language type : char(10) max_length : 10
 * @property string $status status type : enum('ACTIVE','INACTIVE') max_length : 8
 * @property integer $clicked clicked type : int(11)
 * @property string $description description type : text max_length : 
 * @property datetime $created_time created_time type : datetime
 * @property datetime $modified_time modified_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Banner[] findById(integer $id) find objects in database by id
 * @method static \Banner findOneById(integer $id) find object in database by id
 * @method static \Banner retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setTermId(integer $term_id) set term_id value
 * @method integer getTermId() get term_id value
 * @method static \Banner[] findByTermId(integer $term_id) find objects in database by term_id
 * @method static \Banner findOneByTermId(integer $term_id) find object in database by term_id
 * @method static \Banner retrieveByTermId(integer $term_id) retrieve object from poll by term_id, get it from db if not exist in poll

 * @method void setFile(string $file) set file value
 * @method string getFile() get file value
 * @method static \Banner[] findByFile(string $file) find objects in database by file
 * @method static \Banner findOneByFile(string $file) find object in database by file
 * @method static \Banner retrieveByFile(string $file) retrieve object from poll by file, get it from db if not exist in poll

 * @method void setTitle(string $title) set title value
 * @method string getTitle() get title value
 * @method static \Banner[] findByTitle(string $title) find objects in database by title
 * @method static \Banner findOneByTitle(string $title) find object in database by title
 * @method static \Banner retrieveByTitle(string $title) retrieve object from poll by title, get it from db if not exist in poll

 * @method void setOrdering(integer $ordering) set ordering value
 * @method integer getOrdering() get ordering value
 * @method static \Banner[] findByOrdering(integer $ordering) find objects in database by ordering
 * @method static \Banner findOneByOrdering(integer $ordering) find object in database by ordering
 * @method static \Banner retrieveByOrdering(integer $ordering) retrieve object from poll by ordering, get it from db if not exist in poll

 * @method void setImgAlt(string $img_alt) set img_alt value
 * @method string getImgAlt() get img_alt value
 * @method static \Banner[] findByImgAlt(string $img_alt) find objects in database by img_alt
 * @method static \Banner findOneByImgAlt(string $img_alt) find object in database by img_alt
 * @method static \Banner retrieveByImgAlt(string $img_alt) retrieve object from poll by img_alt, get it from db if not exist in poll

 * @method void setLink(string $link) set link value
 * @method string getLink() get link value
 * @method static \Banner[] findByLink(string $link) find objects in database by link
 * @method static \Banner findOneByLink(string $link) find object in database by link
 * @method static \Banner retrieveByLink(string $link) retrieve object from poll by link, get it from db if not exist in poll

 * @method void setLinkTarget(string $link_target) set link_target value
 * @method string getLinkTarget() get link_target value
 * @method static \Banner[] findByLinkTarget(string $link_target) find objects in database by link_target
 * @method static \Banner findOneByLinkTarget(string $link_target) find object in database by link_target
 * @method static \Banner retrieveByLinkTarget(string $link_target) retrieve object from poll by link_target, get it from db if not exist in poll

 * @method void setAutoSize(integer $auto_size) set auto_size value
 * @method integer getAutoSize() get auto_size value
 * @method static \Banner[] findByAutoSize(integer $auto_size) find objects in database by auto_size
 * @method static \Banner findOneByAutoSize(integer $auto_size) find object in database by auto_size
 * @method static \Banner retrieveByAutoSize(integer $auto_size) retrieve object from poll by auto_size, get it from db if not exist in poll

 * @method void setWidth(integer $width) set width value
 * @method integer getWidth() get width value
 * @method static \Banner[] findByWidth(integer $width) find objects in database by width
 * @method static \Banner findOneByWidth(integer $width) find object in database by width
 * @method static \Banner retrieveByWidth(integer $width) retrieve object from poll by width, get it from db if not exist in poll

 * @method void setHeight(integer $height) set height value
 * @method integer getHeight() get height value
 * @method static \Banner[] findByHeight(integer $height) find objects in database by height
 * @method static \Banner findOneByHeight(integer $height) find object in database by height
 * @method static \Banner retrieveByHeight(integer $height) retrieve object from poll by height, get it from db if not exist in poll

 * @method void setWrapperId(string $wrapper_id) set wrapper_id value
 * @method string getWrapperId() get wrapper_id value
 * @method static \Banner[] findByWrapperId(string $wrapper_id) find objects in database by wrapper_id
 * @method static \Banner findOneByWrapperId(string $wrapper_id) find object in database by wrapper_id
 * @method static \Banner retrieveByWrapperId(string $wrapper_id) retrieve object from poll by wrapper_id, get it from db if not exist in poll

 * @method void setWrapperClass(string $wrapper_class) set wrapper_class value
 * @method string getWrapperClass() get wrapper_class value
 * @method static \Banner[] findByWrapperClass(string $wrapper_class) find objects in database by wrapper_class
 * @method static \Banner findOneByWrapperClass(string $wrapper_class) find object in database by wrapper_class
 * @method static \Banner retrieveByWrapperClass(string $wrapper_class) retrieve object from poll by wrapper_class, get it from db if not exist in poll

 * @method void setIsVisible(string $is_visible) set is_visible value
 * @method string getIsVisible() get is_visible value
 * @method static \Banner[] findByIsVisible(string $is_visible) find objects in database by is_visible
 * @method static \Banner findOneByIsVisible(string $is_visible) find object in database by is_visible
 * @method static \Banner retrieveByIsVisible(string $is_visible) retrieve object from poll by is_visible, get it from db if not exist in poll

 * @method void setLanguage(string $language) set language value
 * @method string getLanguage() get language value
 * @method static \Banner[] findByLanguage(string $language) find objects in database by language
 * @method static \Banner findOneByLanguage(string $language) find object in database by language
 * @method static \Banner retrieveByLanguage(string $language) retrieve object from poll by language, get it from db if not exist in poll

 * @method void setStatus(string $status) set status value
 * @method string getStatus() get status value
 * @method static \Banner[] findByStatus(string $status) find objects in database by status
 * @method static \Banner findOneByStatus(string $status) find object in database by status
 * @method static \Banner retrieveByStatus(string $status) retrieve object from poll by status, get it from db if not exist in poll

 * @method void setClicked(integer $clicked) set clicked value
 * @method integer getClicked() get clicked value
 * @method static \Banner[] findByClicked(integer $clicked) find objects in database by clicked
 * @method static \Banner findOneByClicked(integer $clicked) find object in database by clicked
 * @method static \Banner retrieveByClicked(integer $clicked) retrieve object from poll by clicked, get it from db if not exist in poll

 * @method void setDescription(string $description) set description value
 * @method string getDescription() get description value
 * @method static \Banner[] findByDescription(string $description) find objects in database by description
 * @method static \Banner findOneByDescription(string $description) find object in database by description
 * @method static \Banner retrieveByDescription(string $description) retrieve object from poll by description, get it from db if not exist in poll

 * @method void setCreatedTime(\Flywheel\Db\Type\DateTime $created_time) setCreatedTime(string $created_time) set created_time value
 * @method \Flywheel\Db\Type\DateTime getCreatedTime() get created_time value
 * @method static \Banner[] findByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \Banner findOneByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \Banner retrieveByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) retrieveByCreatedTime(string $created_time) retrieve object from poll by created_time, get it from db if not exist in poll

 * @method void setModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) setModifiedTime(string $modified_time) set modified_time value
 * @method \Flywheel\Db\Type\DateTime getModifiedTime() get modified_time value
 * @method static \Banner[] findByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \Banner findOneByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findOneByModifiedTime(string $modified_time) find object in database by modified_time
 * @method static \Banner retrieveByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) retrieveByModifiedTime(string $modified_time) retrieve object from poll by modified_time, get it from db if not exist in poll


 */
abstract class BannerBase extends ActiveRecord {
    protected static $_tableName = 'banner';
    protected static $_phpName = 'Banner';
    protected static $_pk = 'id';
    protected static $_alias = 'b';
    protected static $_dbConnectName = 'banner';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'term_id' => array('name' => 'term_id',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'file' => array('name' => 'file',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'title' => array('name' => 'title',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'ordering' => array('name' => 'ordering',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'img_alt' => array('name' => 'img_alt',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'link' => array('name' => 'link',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'link_target' => array('name' => 'link_target',
                'default' => '_self',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(10)',
                'length' => 10),
        'auto_size' => array('name' => 'auto_size',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'width' => array('name' => 'width',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'height' => array('name' => 'height',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'wrapper_id' => array('name' => 'wrapper_id',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'wrapper_class' => array('name' => 'wrapper_class',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'is_visible' => array('name' => 'is_visible',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'language' => array('name' => 'language',
                'default' => '*',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'char(10)',
                'length' => 10),
        'status' => array('name' => 'status',
                'default' => 'ACTIVE',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'ACTIVE\',\'INACTIVE\')',
                'length' => 8),
        'clicked' => array('name' => 'clicked',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'description' => array('name' => 'description',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'text'),
        'created_time' => array('name' => 'created_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'modified_time' => array('name' => 'modified_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
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
    protected static $_cols = array('id','term_id','file','title','ordering','img_alt','link','link_target','auto_size','width','height','wrapper_id','wrapper_class','is_visible','language','status','clicked','description','created_time','modified_time');

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