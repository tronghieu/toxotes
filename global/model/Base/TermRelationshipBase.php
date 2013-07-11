<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * TermRelationship
 *  This class has been auto-generated at 11/07/2013 15:51:38
 * @version		$Id$
 * @package		Model

 * @property integer $object_id object_id primary type : int(11)
 * @property integer $term_id term_id primary type : int(11)
 * @property integer $ordering ordering type : int(11)

 * @method void setObjectId(integer $object_id) set object_id value
 * @method integer getObjectId() get object_id value
 * @method static \TermRelationship[] findByObjectId(integer $object_id) find objects in database by object_id
 * @method static \TermRelationship findOneByObjectId(integer $object_id) find object in database by object_id
 * @method static \TermRelationship retrieveByObjectId(integer $object_id) retrieve object from poll by object_id, get it from db if not exist in poll

 * @method void setTermId(integer $term_id) set term_id value
 * @method integer getTermId() get term_id value
 * @method static \TermRelationship[] findByTermId(integer $term_id) find objects in database by term_id
 * @method static \TermRelationship findOneByTermId(integer $term_id) find object in database by term_id
 * @method static \TermRelationship retrieveByTermId(integer $term_id) retrieve object from poll by term_id, get it from db if not exist in poll

 * @method void setOrdering(integer $ordering) set ordering value
 * @method integer getOrdering() get ordering value
 * @method static \TermRelationship[] findByOrdering(integer $ordering) find objects in database by ordering
 * @method static \TermRelationship findOneByOrdering(integer $ordering) find object in database by ordering
 * @method static \TermRelationship retrieveByOrdering(integer $ordering) retrieve object from poll by ordering, get it from db if not exist in poll


 */
abstract class TermRelationshipBase extends ActiveRecord {
    protected static $_tableName = 'term_relationship';
    protected static $_phpName = 'TermRelationship';
    protected static $_pk = 'term_id';
    protected static $_alias = 't';
    protected static $_dbConnectName = 'term_relationship';
    protected static $_instances = array();
    protected static $_schema = array(
        'object_id' => array('name' => 'object_id',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'term_id' => array('name' => 'term_id',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'ordering' => array('name' => 'ordering',
                'not_null' => false,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
     );
    protected static $_validate = array(
    );
    protected static $_init = false;
    protected static $_cols = array('object_id','term_id','ordering');

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