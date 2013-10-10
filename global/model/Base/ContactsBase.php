<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Contacts
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $fullname fullname type : varchar(255) max_length : 255
 * @property string $organization organization type : varchar(255) max_length : 255
 * @property string $office_address office_address type : varchar(255) max_length : 255
 * @property string $phone phone type : varchar(255) max_length : 255
 * @property string $mobile mobile type : varchar(255) max_length : 255
 * @property string $fax fax type : varchar(255) max_length : 255
 * @property string $nationality nationality type : varchar(255) max_length : 255
 * @property string $email email type : varchar(255) max_length : 255
 * @property string $other_email other_email type : varchar(255) max_length : 255
 * @property datetime $created_time created_time type : datetime
 * @property datetime $modified_time modified_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Contacts[] findById(integer $id) find objects in database by id
 * @method static \Contacts findOneById(integer $id) find object in database by id
 * @method static \Contacts retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \Contacts[] findByName(string $name) find objects in database by name
 * @method static \Contacts findOneByName(string $name) find object in database by name
 * @method static \Contacts retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll

 * @method void setFullname(string $fullname) set fullname value
 * @method string getFullname() get fullname value
 * @method static \Contacts[] findByFullname(string $fullname) find objects in database by fullname
 * @method static \Contacts findOneByFullname(string $fullname) find object in database by fullname
 * @method static \Contacts retrieveByFullname(string $fullname) retrieve object from poll by fullname, get it from db if not exist in poll

 * @method void setOrganization(string $organization) set organization value
 * @method string getOrganization() get organization value
 * @method static \Contacts[] findByOrganization(string $organization) find objects in database by organization
 * @method static \Contacts findOneByOrganization(string $organization) find object in database by organization
 * @method static \Contacts retrieveByOrganization(string $organization) retrieve object from poll by organization, get it from db if not exist in poll

 * @method void setOfficeAddress(string $office_address) set office_address value
 * @method string getOfficeAddress() get office_address value
 * @method static \Contacts[] findByOfficeAddress(string $office_address) find objects in database by office_address
 * @method static \Contacts findOneByOfficeAddress(string $office_address) find object in database by office_address
 * @method static \Contacts retrieveByOfficeAddress(string $office_address) retrieve object from poll by office_address, get it from db if not exist in poll

 * @method void setPhone(string $phone) set phone value
 * @method string getPhone() get phone value
 * @method static \Contacts[] findByPhone(string $phone) find objects in database by phone
 * @method static \Contacts findOneByPhone(string $phone) find object in database by phone
 * @method static \Contacts retrieveByPhone(string $phone) retrieve object from poll by phone, get it from db if not exist in poll

 * @method void setMobile(string $mobile) set mobile value
 * @method string getMobile() get mobile value
 * @method static \Contacts[] findByMobile(string $mobile) find objects in database by mobile
 * @method static \Contacts findOneByMobile(string $mobile) find object in database by mobile
 * @method static \Contacts retrieveByMobile(string $mobile) retrieve object from poll by mobile, get it from db if not exist in poll

 * @method void setFax(string $fax) set fax value
 * @method string getFax() get fax value
 * @method static \Contacts[] findByFax(string $fax) find objects in database by fax
 * @method static \Contacts findOneByFax(string $fax) find object in database by fax
 * @method static \Contacts retrieveByFax(string $fax) retrieve object from poll by fax, get it from db if not exist in poll

 * @method void setNationality(string $nationality) set nationality value
 * @method string getNationality() get nationality value
 * @method static \Contacts[] findByNationality(string $nationality) find objects in database by nationality
 * @method static \Contacts findOneByNationality(string $nationality) find object in database by nationality
 * @method static \Contacts retrieveByNationality(string $nationality) retrieve object from poll by nationality, get it from db if not exist in poll

 * @method void setEmail(string $email) set email value
 * @method string getEmail() get email value
 * @method static \Contacts[] findByEmail(string $email) find objects in database by email
 * @method static \Contacts findOneByEmail(string $email) find object in database by email
 * @method static \Contacts retrieveByEmail(string $email) retrieve object from poll by email, get it from db if not exist in poll

 * @method void setOtherEmail(string $other_email) set other_email value
 * @method string getOtherEmail() get other_email value
 * @method static \Contacts[] findByOtherEmail(string $other_email) find objects in database by other_email
 * @method static \Contacts findOneByOtherEmail(string $other_email) find object in database by other_email
 * @method static \Contacts retrieveByOtherEmail(string $other_email) retrieve object from poll by other_email, get it from db if not exist in poll

 * @method void setCreatedTime(\Flywheel\Db\Type\DateTime $created_time) setCreatedTime(string $created_time) set created_time value
 * @method \Flywheel\Db\Type\DateTime getCreatedTime() get created_time value
 * @method static \Contacts[] findByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \Contacts findOneByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \Contacts retrieveByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) retrieveByCreatedTime(string $created_time) retrieve object from poll by created_time, get it from db if not exist in poll

 * @method void setModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) setModifiedTime(string $modified_time) set modified_time value
 * @method \Flywheel\Db\Type\DateTime getModifiedTime() get modified_time value
 * @method static \Contacts[] findByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \Contacts findOneByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findOneByModifiedTime(string $modified_time) find object in database by modified_time
 * @method static \Contacts retrieveByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) retrieveByModifiedTime(string $modified_time) retrieve object from poll by modified_time, get it from db if not exist in poll


 */
abstract class ContactsBase extends ActiveRecord {
    protected static $_tableName = 'contacts';
    protected static $_phpName = 'Contacts';
    protected static $_pk = 'id';
    protected static $_alias = 'c';
    protected static $_dbConnectName = 'contacts';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'name' => array('name' => 'name',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'fullname' => array('name' => 'fullname',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'organization' => array('name' => 'organization',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'office_address' => array('name' => 'office_address',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'phone' => array('name' => 'phone',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'mobile' => array('name' => 'mobile',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'fax' => array('name' => 'fax',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'nationality' => array('name' => 'nationality',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'email' => array('name' => 'email',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'other_email' => array('name' => 'other_email',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'created_time' => array('name' => 'created_time',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'modified_time' => array('name' => 'modified_time',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
     );
    protected static $_validate = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','name','fullname','organization','office_address','phone','mobile','fax','nationality','email','other_email','created_time','modified_time');

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