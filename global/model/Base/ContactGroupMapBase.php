<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * ContactGroupMap
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $contact_id contact_id type : int(11)
 * @property integer $group_id group_id type : int(11)

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \ContactGroupMap[] findById(integer $id) find objects in database by id
 * @method static \ContactGroupMap findOneById(integer $id) find object in database by id
 * @method static \ContactGroupMap retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setContactId(integer $contact_id) set contact_id value
 * @method integer getContactId() get contact_id value
 * @method static \ContactGroupMap[] findByContactId(integer $contact_id) find objects in database by contact_id
 * @method static \ContactGroupMap findOneByContactId(integer $contact_id) find object in database by contact_id
 * @method static \ContactGroupMap retrieveByContactId(integer $contact_id) retrieve object from poll by contact_id, get it from db if not exist in poll

 * @method void setGroupId(integer $group_id) set group_id value
 * @method integer getGroupId() get group_id value
 * @method static \ContactGroupMap[] findByGroupId(integer $group_id) find objects in database by group_id
 * @method static \ContactGroupMap findOneByGroupId(integer $group_id) find object in database by group_id
 * @method static \ContactGroupMap retrieveByGroupId(integer $group_id) retrieve object from poll by group_id, get it from db if not exist in poll


 */
abstract class ContactGroupMapBase extends ActiveRecord {
    protected static $_tableName = 'contact_group_map';
    protected static $_phpName = 'ContactGroupMap';
    protected static $_pk = 'id';
    protected static $_alias = 'c';
    protected static $_dbConnectName = 'contact_group_map';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'contact_id' => array('name' => 'contact_id',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'group_id' => array('name' => 'group_id',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
     );
    protected static $_validate = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','contact_id','group_id');

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