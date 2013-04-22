<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * ItemImages
 *  This class has been auto-generated at 22/04/2013 18:00:34
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $item_id item_id type : int(11)
 * @property string $caption caption type : varchar(255) max_length : 255
 * @property integer $is_main is_main type : tinyint(1)

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \ItemImages[] findById(integer $id) find objects in database by id
 * @method static \ItemImages findOneById(integer $id) find object in database by id
 * @method static \ItemImages retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setItemId(integer $item_id) set item_id value
 * @method integer getItemId() get item_id value
 * @method static \ItemImages[] findByItemId(integer $item_id) find objects in database by item_id
 * @method static \ItemImages findOneByItemId(integer $item_id) find object in database by item_id
 * @method static \ItemImages retrieveByItemId(integer $item_id) retrieve object from poll by item_id, get it from db if not exist in poll

 * @method void setCaption(string $caption) set caption value
 * @method string getCaption() get caption value
 * @method static \ItemImages[] findByCaption(string $caption) find objects in database by caption
 * @method static \ItemImages findOneByCaption(string $caption) find object in database by caption
 * @method static \ItemImages retrieveByCaption(string $caption) retrieve object from poll by caption, get it from db if not exist in poll

 * @method void setIsMain(integer $is_main) set is_main value
 * @method integer getIsMain() get is_main value
 * @method static \ItemImages[] findByIsMain(integer $is_main) find objects in database by is_main
 * @method static \ItemImages findOneByIsMain(integer $is_main) find object in database by is_main
 * @method static \ItemImages retrieveByIsMain(integer $is_main) retrieve object from poll by is_main, get it from db if not exist in poll


 */
abstract class ItemImagesBase extends ActiveRecord {
    protected static $_tableName = 'item_images';
    protected static $_phpName = 'ItemImages';
    protected static $_pk = 'id';
    protected static $_alias = 'i';
    protected static $_dbConnectName = 'item_images';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'item_id' => array('name' => 'item_id',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'caption' => array('name' => 'caption',
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'is_main' => array('name' => 'is_main',
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
     );
    protected static $_validate = array(
    );
    protected static $_cols = array('id','item_id','caption','is_main');

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