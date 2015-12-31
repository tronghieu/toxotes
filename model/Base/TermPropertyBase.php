<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * TermProperty
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $term_id term_id type : int(11)
 * @property string $property_key property_key type : varchar(255) max_length : 255
 * @property string $property_value property_value type : text max_length : 

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \TermProperty[] findById(integer $id) find objects in database by id
 * @method static \TermProperty findOneById(integer $id) find object in database by id
 * @method static \TermProperty retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setTermId(integer $term_id) set term_id value
 * @method integer getTermId() get term_id value
 * @method static \TermProperty[] findByTermId(integer $term_id) find objects in database by term_id
 * @method static \TermProperty findOneByTermId(integer $term_id) find object in database by term_id
 * @method static \TermProperty retrieveByTermId(integer $term_id) retrieve object from poll by term_id, get it from db if not exist in poll

 * @method void setPropertyKey(string $property_key) set property_key value
 * @method string getPropertyKey() get property_key value
 * @method static \TermProperty[] findByPropertyKey(string $property_key) find objects in database by property_key
 * @method static \TermProperty findOneByPropertyKey(string $property_key) find object in database by property_key
 * @method static \TermProperty retrieveByPropertyKey(string $property_key) retrieve object from poll by property_key, get it from db if not exist in poll

 * @method void setPropertyValue(string $property_value) set property_value value
 * @method string getPropertyValue() get property_value value
 * @method static \TermProperty[] findByPropertyValue(string $property_value) find objects in database by property_value
 * @method static \TermProperty findOneByPropertyValue(string $property_value) find object in database by property_value
 * @method static \TermProperty retrieveByPropertyValue(string $property_value) retrieve object from poll by property_value, get it from db if not exist in poll


 */
abstract class TermPropertyBase extends ActiveRecord {
    protected static $_tableName = 'term_property';
    protected static $_phpName = 'TermProperty';
    protected static $_pk = 'id';
    protected static $_alias = 't';
    protected static $_dbConnectName = 'term_property';
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
        'property_key' => array('name' => 'property_key',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'property_value' => array('name' => 'property_value',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'text'),
     );
    protected static $_validate = array(
    );
    protected static $_validatorRules = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','term_id','property_key','property_value');

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