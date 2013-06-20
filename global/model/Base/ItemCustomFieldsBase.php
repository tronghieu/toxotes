<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * ItemCustomFields
 *  This class has been auto-generated at 19/06/2013 18:40:11
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $item_id item_id type : int(11)
 * @property integer $cf_id cf_id type : int(11)
 * @property string $text_value text_value type : text max_length : 
 * @property number $number_value number_value type : double(20,2)
 * @property integer $bool_value bool_value type : tinyint(4)
 * @property datetime $datetime_value datetime_value type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \ItemCustomFields[] findById(integer $id) find objects in database by id
 * @method static \ItemCustomFields findOneById(integer $id) find object in database by id
 * @method static \ItemCustomFields retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setItemId(integer $item_id) set item_id value
 * @method integer getItemId() get item_id value
 * @method static \ItemCustomFields[] findByItemId(integer $item_id) find objects in database by item_id
 * @method static \ItemCustomFields findOneByItemId(integer $item_id) find object in database by item_id
 * @method static \ItemCustomFields retrieveByItemId(integer $item_id) retrieve object from poll by item_id, get it from db if not exist in poll

 * @method void setCfId(integer $cf_id) set cf_id value
 * @method integer getCfId() get cf_id value
 * @method static \ItemCustomFields[] findByCfId(integer $cf_id) find objects in database by cf_id
 * @method static \ItemCustomFields findOneByCfId(integer $cf_id) find object in database by cf_id
 * @method static \ItemCustomFields retrieveByCfId(integer $cf_id) retrieve object from poll by cf_id, get it from db if not exist in poll

 * @method void setTextValue(string $text_value) set text_value value
 * @method string getTextValue() get text_value value
 * @method static \ItemCustomFields[] findByTextValue(string $text_value) find objects in database by text_value
 * @method static \ItemCustomFields findOneByTextValue(string $text_value) find object in database by text_value
 * @method static \ItemCustomFields retrieveByTextValue(string $text_value) retrieve object from poll by text_value, get it from db if not exist in poll

 * @method void setNumberValue(number $number_value) set number_value value
 * @method number getNumberValue() get number_value value
 * @method static \ItemCustomFields[] findByNumberValue(number $number_value) find objects in database by number_value
 * @method static \ItemCustomFields findOneByNumberValue(number $number_value) find object in database by number_value
 * @method static \ItemCustomFields retrieveByNumberValue(number $number_value) retrieve object from poll by number_value, get it from db if not exist in poll

 * @method void setBoolValue(integer $bool_value) set bool_value value
 * @method integer getBoolValue() get bool_value value
 * @method static \ItemCustomFields[] findByBoolValue(integer $bool_value) find objects in database by bool_value
 * @method static \ItemCustomFields findOneByBoolValue(integer $bool_value) find object in database by bool_value
 * @method static \ItemCustomFields retrieveByBoolValue(integer $bool_value) retrieve object from poll by bool_value, get it from db if not exist in poll

 * @method void setDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) setDatetimeValue(string $datetime_value) set datetime_value value
 * @method \Flywheel\Db\Type\DateTime getDatetimeValue() get datetime_value value
 * @method static \ItemCustomFields[] findByDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) findByDatetimeValue(string $datetime_value) find objects in database by datetime_value
 * @method static \ItemCustomFields findOneByDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) findOneByDatetimeValue(string $datetime_value) find object in database by datetime_value
 * @method static \ItemCustomFields retrieveByDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) retrieveByDatetimeValue(string $datetime_value) retrieve object from poll by datetime_value, get it from db if not exist in poll


 */
abstract class ItemCustomFieldsBase extends ActiveRecord {
    protected static $_tableName = 'item_custom_fields';
    protected static $_phpName = 'ItemCustomFields';
    protected static $_pk = 'id';
    protected static $_alias = 'i';
    protected static $_dbConnectName = 'item_custom_fields';
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
        'cf_id' => array('name' => 'cf_id',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'text_value' => array('name' => 'text_value',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'number_value' => array('name' => 'number_value',
                'default' => 0.00,
                'not_null' => true,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'double(20,2)',
                'length' => 20),
        'bool_value' => array('name' => 'bool_value',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(4)',
                'length' => 1),
        'datetime_value' => array('name' => 'datetime_value',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
     );
    protected static $_validate = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','item_id','cf_id','text_value','number_value','bool_value','datetime_value');

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