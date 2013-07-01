<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * TermProperty
 *  This class has been auto-generated at 01/07/2013 01:32:44
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $term_id term_id type : int(11)
 * @property string $property property type : varchar(255) max_length : 255
 * @property string $text_value text_value type : text max_length : 
 * @property integer $int_value int_value type : int(11)
 * @property number $float_value float_value type : decimal(20,4)
 * @property integer $bolean_value bolean_value type : tinyint(1)
 * @property datetime $datetime_value datetime_value type : datetime
 * @property integer $ordering ordering type : int(11)

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

 * @method void setProperty(string $property) set property value
 * @method string getProperty() get property value
 * @method static \TermProperty[] findByProperty(string $property) find objects in database by property
 * @method static \TermProperty findOneByProperty(string $property) find object in database by property
 * @method static \TermProperty retrieveByProperty(string $property) retrieve object from poll by property, get it from db if not exist in poll

 * @method void setTextValue(string $text_value) set text_value value
 * @method string getTextValue() get text_value value
 * @method static \TermProperty[] findByTextValue(string $text_value) find objects in database by text_value
 * @method static \TermProperty findOneByTextValue(string $text_value) find object in database by text_value
 * @method static \TermProperty retrieveByTextValue(string $text_value) retrieve object from poll by text_value, get it from db if not exist in poll

 * @method void setIntValue(integer $int_value) set int_value value
 * @method integer getIntValue() get int_value value
 * @method static \TermProperty[] findByIntValue(integer $int_value) find objects in database by int_value
 * @method static \TermProperty findOneByIntValue(integer $int_value) find object in database by int_value
 * @method static \TermProperty retrieveByIntValue(integer $int_value) retrieve object from poll by int_value, get it from db if not exist in poll

 * @method void setFloatValue(number $float_value) set float_value value
 * @method number getFloatValue() get float_value value
 * @method static \TermProperty[] findByFloatValue(number $float_value) find objects in database by float_value
 * @method static \TermProperty findOneByFloatValue(number $float_value) find object in database by float_value
 * @method static \TermProperty retrieveByFloatValue(number $float_value) retrieve object from poll by float_value, get it from db if not exist in poll

 * @method void setBoleanValue(integer $bolean_value) set bolean_value value
 * @method integer getBoleanValue() get bolean_value value
 * @method static \TermProperty[] findByBoleanValue(integer $bolean_value) find objects in database by bolean_value
 * @method static \TermProperty findOneByBoleanValue(integer $bolean_value) find object in database by bolean_value
 * @method static \TermProperty retrieveByBoleanValue(integer $bolean_value) retrieve object from poll by bolean_value, get it from db if not exist in poll

 * @method void setDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) setDatetimeValue(string $datetime_value) set datetime_value value
 * @method \Flywheel\Db\Type\DateTime getDatetimeValue() get datetime_value value
 * @method static \TermProperty[] findByDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) findByDatetimeValue(string $datetime_value) find objects in database by datetime_value
 * @method static \TermProperty findOneByDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) findOneByDatetimeValue(string $datetime_value) find object in database by datetime_value
 * @method static \TermProperty retrieveByDatetimeValue(\Flywheel\Db\Type\DateTime $datetime_value) retrieveByDatetimeValue(string $datetime_value) retrieve object from poll by datetime_value, get it from db if not exist in poll

 * @method void setOrdering(integer $ordering) set ordering value
 * @method integer getOrdering() get ordering value
 * @method static \TermProperty[] findByOrdering(integer $ordering) find objects in database by ordering
 * @method static \TermProperty findOneByOrdering(integer $ordering) find object in database by ordering
 * @method static \TermProperty retrieveByOrdering(integer $ordering) retrieve object from poll by ordering, get it from db if not exist in poll


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
        'property' => array('name' => 'property',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'text_value' => array('name' => 'text_value',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'text'),
        'int_value' => array('name' => 'int_value',
                'default' => 0,
                'not_null' => false,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'float_value' => array('name' => 'float_value',
                'not_null' => false,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'decimal(20,4)',
                'length' => 20),
        'bolean_value' => array('name' => 'bolean_value',
                'not_null' => false,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'datetime_value' => array('name' => 'datetime_value',
                'not_null' => false,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'ordering' => array('name' => 'ordering',
                'default' => 1,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
     );
    protected static $_validate = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','term_id','property','text_value','int_value','float_value','bolean_value','datetime_value','ordering');

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