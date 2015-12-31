<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Setting
 * @version		$Id$
 * @package		Model

 * @property string $setting_key setting_key primary type : varchar(255) max_length : 255
 * @property string $setting_value setting_value type : text max_length : 

 * @method void setSettingKey(string $setting_key) set setting_key value
 * @method string getSettingKey() get setting_key value
 * @method static \Setting[] findBySettingKey(string $setting_key) find objects in database by setting_key
 * @method static \Setting findOneBySettingKey(string $setting_key) find object in database by setting_key
 * @method static \Setting retrieveBySettingKey(string $setting_key) retrieve object from poll by setting_key, get it from db if not exist in poll

 * @method void setSettingValue(string $setting_value) set setting_value value
 * @method string getSettingValue() get setting_value value
 * @method static \Setting[] findBySettingValue(string $setting_value) find objects in database by setting_value
 * @method static \Setting findOneBySettingValue(string $setting_value) find object in database by setting_value
 * @method static \Setting retrieveBySettingValue(string $setting_value) retrieve object from poll by setting_value, get it from db if not exist in poll


 */
abstract class SettingBase extends ActiveRecord {
    protected static $_tableName = 'setting';
    protected static $_phpName = 'Setting';
    protected static $_pk = 'setting_key';
    protected static $_alias = 's';
    protected static $_dbConnectName = 'setting';
    protected static $_instances = array();
    protected static $_schema = array(
        'setting_key' => array('name' => 'setting_key',
                'not_null' => true,
                'type' => 'string',
                'primary' => true,
                'db_type' => 'varchar(255)',
                'length' => 255),
        'setting_value' => array('name' => 'setting_value',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
     );
    protected static $_validate = array(
    );
    protected static $_validatorRules = array(
    );
    protected static $_init = false;
    protected static $_cols = array('setting_key','setting_value');

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