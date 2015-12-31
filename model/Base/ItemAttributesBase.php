<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * ItemAttributes
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $item_id item_id type : int(11) unsigned
 * @property string $attribute attribute type : varchar(255) max_length : 255
 * @property string $values values type : text max_length : 

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \ItemAttributes[] findById(integer $id) find objects in database by id
 * @method static \ItemAttributes findOneById(integer $id) find object in database by id
 * @method static \ItemAttributes retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setItemId(integer $item_id) set item_id value
 * @method integer getItemId() get item_id value
 * @method static \ItemAttributes[] findByItemId(integer $item_id) find objects in database by item_id
 * @method static \ItemAttributes findOneByItemId(integer $item_id) find object in database by item_id
 * @method static \ItemAttributes retrieveByItemId(integer $item_id) retrieve object from poll by item_id, get it from db if not exist in poll

 * @method void setAttribute(string $attribute) set attribute value
 * @method string getAttribute() get attribute value
 * @method static \ItemAttributes[] findByAttribute(string $attribute) find objects in database by attribute
 * @method static \ItemAttributes findOneByAttribute(string $attribute) find object in database by attribute
 * @method static \ItemAttributes retrieveByAttribute(string $attribute) retrieve object from poll by attribute, get it from db if not exist in poll

 * @method void setValues(string $values) set values value
 * @method string getValues() get values value
 * @method static \ItemAttributes[] findByValues(string $values) find objects in database by values
 * @method static \ItemAttributes findOneByValues(string $values) find object in database by values
 * @method static \ItemAttributes retrieveByValues(string $values) retrieve object from poll by values, get it from db if not exist in poll


 */
abstract class ItemAttributesBase extends ActiveRecord {
    protected static $_tableName = 'item_attributes';
    protected static $_phpName = 'ItemAttributes';
    protected static $_pk = 'id';
    protected static $_alias = 'i';
    protected static $_dbConnectName = 'item_attributes';
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
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'attribute' => array('name' => 'attribute',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'values' => array('name' => 'values',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
     );
    protected static $_validate = array(
    );
    protected static $_validatorRules = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','item_id','attribute','values');

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