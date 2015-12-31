<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * TermCustomFields
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $term_id term_id type : int(11)
 * @property string $field_key field_key type : varchar(255) max_length : 255
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $type type type : enum('INPUT','TEXTAREA','RADIO','SELECT') max_length : 8
 * @property string $accept_value accept_value type : text max_length : 
 * @property string $format format type : enum('TEXT','NUMBER','BOOL','DATETIME') max_length : 8

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \TermCustomFields[] findById(integer $id) find objects in database by id
 * @method static \TermCustomFields findOneById(integer $id) find object in database by id
 * @method static \TermCustomFields retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setTermId(integer $term_id) set term_id value
 * @method integer getTermId() get term_id value
 * @method static \TermCustomFields[] findByTermId(integer $term_id) find objects in database by term_id
 * @method static \TermCustomFields findOneByTermId(integer $term_id) find object in database by term_id
 * @method static \TermCustomFields retrieveByTermId(integer $term_id) retrieve object from poll by term_id, get it from db if not exist in poll

 * @method void setFieldKey(string $field_key) set field_key value
 * @method string getFieldKey() get field_key value
 * @method static \TermCustomFields[] findByFieldKey(string $field_key) find objects in database by field_key
 * @method static \TermCustomFields findOneByFieldKey(string $field_key) find object in database by field_key
 * @method static \TermCustomFields retrieveByFieldKey(string $field_key) retrieve object from poll by field_key, get it from db if not exist in poll

 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \TermCustomFields[] findByName(string $name) find objects in database by name
 * @method static \TermCustomFields findOneByName(string $name) find object in database by name
 * @method static \TermCustomFields retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll

 * @method void setType(string $type) set type value
 * @method string getType() get type value
 * @method static \TermCustomFields[] findByType(string $type) find objects in database by type
 * @method static \TermCustomFields findOneByType(string $type) find object in database by type
 * @method static \TermCustomFields retrieveByType(string $type) retrieve object from poll by type, get it from db if not exist in poll

 * @method void setAcceptValue(string $accept_value) set accept_value value
 * @method string getAcceptValue() get accept_value value
 * @method static \TermCustomFields[] findByAcceptValue(string $accept_value) find objects in database by accept_value
 * @method static \TermCustomFields findOneByAcceptValue(string $accept_value) find object in database by accept_value
 * @method static \TermCustomFields retrieveByAcceptValue(string $accept_value) retrieve object from poll by accept_value, get it from db if not exist in poll

 * @method void setFormat(string $format) set format value
 * @method string getFormat() get format value
 * @method static \TermCustomFields[] findByFormat(string $format) find objects in database by format
 * @method static \TermCustomFields findOneByFormat(string $format) find object in database by format
 * @method static \TermCustomFields retrieveByFormat(string $format) retrieve object from poll by format, get it from db if not exist in poll


 */
abstract class TermCustomFieldsBase extends ActiveRecord {
    protected static $_tableName = 'term_custom_fields';
    protected static $_phpName = 'TermCustomFields';
    protected static $_pk = 'id';
    protected static $_alias = 't';
    protected static $_dbConnectName = 'term_custom_fields';
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
        'field_key' => array('name' => 'field_key',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'name' => array('name' => 'name',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'type' => array('name' => 'type',
                'default' => 'INPUT',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'INPUT\',\'TEXTAREA\',\'RADIO\',\'SELECT\')',
                'length' => 8),
        'accept_value' => array('name' => 'accept_value',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'text'),
        'format' => array('name' => 'format',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'enum(\'TEXT\',\'NUMBER\',\'BOOL\',\'DATETIME\')',
                'length' => 8),
     );
    protected static $_validate = array(
        'type' => array(
            array('name' => 'ValidValues',
                'value' => 'INPUT|TEXTAREA|RADIO|SELECT',
                'message'=> 'type\'s values is not allowed'
            ),
        ),
        'format' => array(
            array('name' => 'ValidValues',
                'value' => 'TEXT|NUMBER|BOOL|DATETIME',
                'message'=> 'format\'s values is not allowed'
            ),
        ),
    );
    protected static $_validatorRules = array(
        'type' => array(
            array('name' => 'ValidValues',
                'value' => 'INPUT|TEXTAREA|RADIO|SELECT',
                'message'=> 'type\'s values is not allowed'
            ),
        ),
        'format' => array(
            array('name' => 'ValidValues',
                'value' => 'TEXT|NUMBER|BOOL|DATETIME',
                'message'=> 'format\'s values is not allowed'
            ),
        ),
    );
    protected static $_init = false;
    protected static $_cols = array('id','term_id','field_key','name','type','accept_value','format');

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