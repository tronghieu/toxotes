<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * ItemAttachments
 *  This class has been auto-generated at 22/05/2013 10:31:43
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $item_id item_id type : int(11)
 * @property string $file file type : text max_length : 
 * @property string $mine_type mine_type type : text max_length : 
 * @property string $type_group type_group type : varchar(100) max_length : 100
 * @property datetime $uploaded_time uploaded_time type : datetime
 * @property integer $hits hits type : int(11)

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \ItemAttachments[] findById(integer $id) find objects in database by id
 * @method static \ItemAttachments findOneById(integer $id) find object in database by id
 * @method static \ItemAttachments retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setItemId(integer $item_id) set item_id value
 * @method integer getItemId() get item_id value
 * @method static \ItemAttachments[] findByItemId(integer $item_id) find objects in database by item_id
 * @method static \ItemAttachments findOneByItemId(integer $item_id) find object in database by item_id
 * @method static \ItemAttachments retrieveByItemId(integer $item_id) retrieve object from poll by item_id, get it from db if not exist in poll

 * @method void setFile(string $file) set file value
 * @method string getFile() get file value
 * @method static \ItemAttachments[] findByFile(string $file) find objects in database by file
 * @method static \ItemAttachments findOneByFile(string $file) find object in database by file
 * @method static \ItemAttachments retrieveByFile(string $file) retrieve object from poll by file, get it from db if not exist in poll

 * @method void setMineType(string $mine_type) set mine_type value
 * @method string getMineType() get mine_type value
 * @method static \ItemAttachments[] findByMineType(string $mine_type) find objects in database by mine_type
 * @method static \ItemAttachments findOneByMineType(string $mine_type) find object in database by mine_type
 * @method static \ItemAttachments retrieveByMineType(string $mine_type) retrieve object from poll by mine_type, get it from db if not exist in poll

 * @method void setTypeGroup(string $type_group) set type_group value
 * @method string getTypeGroup() get type_group value
 * @method static \ItemAttachments[] findByTypeGroup(string $type_group) find objects in database by type_group
 * @method static \ItemAttachments findOneByTypeGroup(string $type_group) find object in database by type_group
 * @method static \ItemAttachments retrieveByTypeGroup(string $type_group) retrieve object from poll by type_group, get it from db if not exist in poll

 * @method void setUploadedTime(\Flywheel\Db\Type\DateTime $uploaded_time) setUploadedTime(string $uploaded_time) set uploaded_time value
 * @method \Flywheel\Db\Type\DateTime getUploadedTime() get uploaded_time value
 * @method static \ItemAttachments[] findByUploadedTime(\Flywheel\Db\Type\DateTime $uploaded_time) findByUploadedTime(string $uploaded_time) find objects in database by uploaded_time
 * @method static \ItemAttachments findOneByUploadedTime(\Flywheel\Db\Type\DateTime $uploaded_time) findOneByUploadedTime(string $uploaded_time) find object in database by uploaded_time
 * @method static \ItemAttachments retrieveByUploadedTime(\Flywheel\Db\Type\DateTime $uploaded_time) retrieveByUploadedTime(string $uploaded_time) retrieve object from poll by uploaded_time, get it from db if not exist in poll

 * @method void setHits(integer $hits) set hits value
 * @method integer getHits() get hits value
 * @method static \ItemAttachments[] findByHits(integer $hits) find objects in database by hits
 * @method static \ItemAttachments findOneByHits(integer $hits) find object in database by hits
 * @method static \ItemAttachments retrieveByHits(integer $hits) retrieve object from poll by hits, get it from db if not exist in poll


 */
abstract class ItemAttachmentsBase extends ActiveRecord {
    protected static $_tableName = 'item_attachments';
    protected static $_phpName = 'ItemAttachments';
    protected static $_pk = 'id';
    protected static $_alias = 'i';
    protected static $_dbConnectName = 'item_attachments';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'item_id' => array('name' => 'item_id',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'file' => array('name' => 'file',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'mine_type' => array('name' => 'mine_type',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'type_group' => array('name' => 'type_group',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'uploaded_time' => array('name' => 'uploaded_time',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'hits' => array('name' => 'hits',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
     );
    protected static $_validate = array(
    );
    protected static $_cols = array('id','item_id','file','mine_type','type_group','uploaded_time','hits');

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