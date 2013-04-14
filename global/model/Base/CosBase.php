<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Cos
 *  This class has been auto-generated at 03/04/2013 14:50:59
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $from_time from_time type : datetime max_length : 
 * @property string $to_time to_time type : datetime max_length : 
 * @property string $track_time track_time type : timestamp max_length : 

 * @method static \Cos[] findById(integer $id) find objects in database by id
 * @method static \Cos findOneById(integer $id) find object in database by id
 * @method static \Cos[] findByFromTime(string $from_time) find objects in database by from_time
 * @method static \Cos findOneByFromTime(string $from_time) find object in database by from_time
 * @method static \Cos[] findByToTime(string $to_time) find objects in database by to_time
 * @method static \Cos findOneByToTime(string $to_time) find object in database by to_time
 * @method static \Cos[] findByTrackTime(string $track_time) find objects in database by track_time
 * @method static \Cos findOneByTrackTime(string $track_time) find object in database by track_time

 */
abstract class CosBase extends ActiveRecord {
    protected static $_tableName = 'cos';
    protected static $_pk = 'id';
    protected static $_alias = 'c';
    protected static $_dbConnectName = 'cos';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'from_time' => array('name' => 'from_time',
                'type' => 'string',
                'db_type' => 'datetime'),
        'to_time' => array('name' => 'to_time',
                'type' => 'string',
                'db_type' => 'datetime'),
        'track_time' => array('name' => 'track_time',
                'type' => 'string',
                'db_type' => 'timestamp'),
);
    protected static $_validate = array(
        'to_time' => array('require' => '"to_time" is required!'),
);
    protected static $_cols = array('id','from_time','to_time','track_time');

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
            return true;
        }
        catch (\Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }
}