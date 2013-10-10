<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * MailMessage
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $is_draft is_draft type : int(11)
 * @property string $subject subject type : varchar(255) max_length : 255
 * @property string $body body type : text max_length : 
 * @property string $from_name from_name type : varchar(255) max_length : 255
 * @property string $from_address from_address type : varchar(255) max_length : 255
 * @property string $recipients recipients type : text max_length : 
 * @property string $sent sent type : enum('YES','NO') max_length : 3
 * @property integer $retry_time retry_time type : int(11)
 * @property string $attachments attachments type : text max_length : 
 * @property datetime $created_time created_time type : datetime
 * @property datetime $modified_time modified_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \MailMessage[] findById(integer $id) find objects in database by id
 * @method static \MailMessage findOneById(integer $id) find object in database by id
 * @method static \MailMessage retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setIsDraft(integer $is_draft) set is_draft value
 * @method integer getIsDraft() get is_draft value
 * @method static \MailMessage[] findByIsDraft(integer $is_draft) find objects in database by is_draft
 * @method static \MailMessage findOneByIsDraft(integer $is_draft) find object in database by is_draft
 * @method static \MailMessage retrieveByIsDraft(integer $is_draft) retrieve object from poll by is_draft, get it from db if not exist in poll

 * @method void setSubject(string $subject) set subject value
 * @method string getSubject() get subject value
 * @method static \MailMessage[] findBySubject(string $subject) find objects in database by subject
 * @method static \MailMessage findOneBySubject(string $subject) find object in database by subject
 * @method static \MailMessage retrieveBySubject(string $subject) retrieve object from poll by subject, get it from db if not exist in poll

 * @method void setBody(string $body) set body value
 * @method string getBody() get body value
 * @method static \MailMessage[] findByBody(string $body) find objects in database by body
 * @method static \MailMessage findOneByBody(string $body) find object in database by body
 * @method static \MailMessage retrieveByBody(string $body) retrieve object from poll by body, get it from db if not exist in poll

 * @method void setFromName(string $from_name) set from_name value
 * @method string getFromName() get from_name value
 * @method static \MailMessage[] findByFromName(string $from_name) find objects in database by from_name
 * @method static \MailMessage findOneByFromName(string $from_name) find object in database by from_name
 * @method static \MailMessage retrieveByFromName(string $from_name) retrieve object from poll by from_name, get it from db if not exist in poll

 * @method void setFromAddress(string $from_address) set from_address value
 * @method string getFromAddress() get from_address value
 * @method static \MailMessage[] findByFromAddress(string $from_address) find objects in database by from_address
 * @method static \MailMessage findOneByFromAddress(string $from_address) find object in database by from_address
 * @method static \MailMessage retrieveByFromAddress(string $from_address) retrieve object from poll by from_address, get it from db if not exist in poll

 * @method void setRecipients(string $recipients) set recipients value
 * @method string getRecipients() get recipients value
 * @method static \MailMessage[] findByRecipients(string $recipients) find objects in database by recipients
 * @method static \MailMessage findOneByRecipients(string $recipients) find object in database by recipients
 * @method static \MailMessage retrieveByRecipients(string $recipients) retrieve object from poll by recipients, get it from db if not exist in poll

 * @method void setSent(string $sent) set sent value
 * @method string getSent() get sent value
 * @method static \MailMessage[] findBySent(string $sent) find objects in database by sent
 * @method static \MailMessage findOneBySent(string $sent) find object in database by sent
 * @method static \MailMessage retrieveBySent(string $sent) retrieve object from poll by sent, get it from db if not exist in poll

 * @method void setRetryTime(integer $retry_time) set retry_time value
 * @method integer getRetryTime() get retry_time value
 * @method static \MailMessage[] findByRetryTime(integer $retry_time) find objects in database by retry_time
 * @method static \MailMessage findOneByRetryTime(integer $retry_time) find object in database by retry_time
 * @method static \MailMessage retrieveByRetryTime(integer $retry_time) retrieve object from poll by retry_time, get it from db if not exist in poll

 * @method void setAttachments(string $attachments) set attachments value
 * @method string getAttachments() get attachments value
 * @method static \MailMessage[] findByAttachments(string $attachments) find objects in database by attachments
 * @method static \MailMessage findOneByAttachments(string $attachments) find object in database by attachments
 * @method static \MailMessage retrieveByAttachments(string $attachments) retrieve object from poll by attachments, get it from db if not exist in poll

 * @method void setCreatedTime(\Flywheel\Db\Type\DateTime $created_time) setCreatedTime(string $created_time) set created_time value
 * @method \Flywheel\Db\Type\DateTime getCreatedTime() get created_time value
 * @method static \MailMessage[] findByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \MailMessage findOneByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \MailMessage retrieveByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) retrieveByCreatedTime(string $created_time) retrieve object from poll by created_time, get it from db if not exist in poll

 * @method void setModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) setModifiedTime(string $modified_time) set modified_time value
 * @method \Flywheel\Db\Type\DateTime getModifiedTime() get modified_time value
 * @method static \MailMessage[] findByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \MailMessage findOneByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findOneByModifiedTime(string $modified_time) find object in database by modified_time
 * @method static \MailMessage retrieveByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) retrieveByModifiedTime(string $modified_time) retrieve object from poll by modified_time, get it from db if not exist in poll


 */
abstract class MailMessageBase extends ActiveRecord {
    protected static $_tableName = 'mail_message';
    protected static $_phpName = 'MailMessage';
    protected static $_pk = 'id';
    protected static $_alias = 'm';
    protected static $_dbConnectName = 'mail_message';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'is_draft' => array('name' => 'is_draft',
                'default' => 1,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'subject' => array('name' => 'subject',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'body' => array('name' => 'body',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'from_name' => array('name' => 'from_name',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'from_address' => array('name' => 'from_address',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'recipients' => array('name' => 'recipients',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'sent' => array('name' => 'sent',
                'default' => 'NO',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'YES\',\'NO\')',
                'length' => 3),
        'retry_time' => array('name' => 'retry_time',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'attachments' => array('name' => 'attachments',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
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
        'sent' => array(
            array('name' => 'ValidValues',
                'value' => 'YES|NO',
                'message'=> 'sent\'s values is not allowed'
            ),
        ),
    );
    protected static $_init = false;
    protected static $_cols = array('id','is_draft','subject','body','from_name','from_address','recipients','sent','retry_time','attachments','created_time','modified_time');

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