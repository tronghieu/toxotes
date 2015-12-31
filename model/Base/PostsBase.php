<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Posts
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property string $title title type : varchar(255) max_length : 255
 * @property integer $term_id term_id type : int(11)
 * @property string $slug slug type : varchar(255) max_length : 255
 * @property string $excerpt excerpt type : text max_length : 
 * @property string $content content type : text max_length : 
 * @property string $status status type : varchar(20) max_length : 20
 * @property integer $is_draft is_draft type : tinyint(1)
 * @property string $author author type : varchar(255) max_length : 255
 * @property string $taxonomy taxonomy type : varchar(100) max_length : 100
 * @property string $language language type : varchar(20) max_length : 20
 * @property integer $ordering ordering type : int(11)
 * @property integer $hits hits type : int(11)
 * @property integer $is_pin is_pin type : tinyint(1)
 * @property datetime $modified_time modified_time type : datetime
 * @property datetime $created_time created_time type : datetime
 * @property datetime $publish_time publish_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Posts[] findById(integer $id) find objects in database by id
 * @method static \Posts findOneById(integer $id) find object in database by id
 * @method static \Posts retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setTitle(string $title) set title value
 * @method string getTitle() get title value
 * @method static \Posts[] findByTitle(string $title) find objects in database by title
 * @method static \Posts findOneByTitle(string $title) find object in database by title
 * @method static \Posts retrieveByTitle(string $title) retrieve object from poll by title, get it from db if not exist in poll

 * @method void setTermId(integer $term_id) set term_id value
 * @method integer getTermId() get term_id value
 * @method static \Posts[] findByTermId(integer $term_id) find objects in database by term_id
 * @method static \Posts findOneByTermId(integer $term_id) find object in database by term_id
 * @method static \Posts retrieveByTermId(integer $term_id) retrieve object from poll by term_id, get it from db if not exist in poll

 * @method void setSlug(string $slug) set slug value
 * @method string getSlug() get slug value
 * @method static \Posts[] findBySlug(string $slug) find objects in database by slug
 * @method static \Posts findOneBySlug(string $slug) find object in database by slug
 * @method static \Posts retrieveBySlug(string $slug) retrieve object from poll by slug, get it from db if not exist in poll

 * @method void setExcerpt(string $excerpt) set excerpt value
 * @method string getExcerpt() get excerpt value
 * @method static \Posts[] findByExcerpt(string $excerpt) find objects in database by excerpt
 * @method static \Posts findOneByExcerpt(string $excerpt) find object in database by excerpt
 * @method static \Posts retrieveByExcerpt(string $excerpt) retrieve object from poll by excerpt, get it from db if not exist in poll

 * @method void setContent(string $content) set content value
 * @method string getContent() get content value
 * @method static \Posts[] findByContent(string $content) find objects in database by content
 * @method static \Posts findOneByContent(string $content) find object in database by content
 * @method static \Posts retrieveByContent(string $content) retrieve object from poll by content, get it from db if not exist in poll

 * @method void setStatus(string $status) set status value
 * @method string getStatus() get status value
 * @method static \Posts[] findByStatus(string $status) find objects in database by status
 * @method static \Posts findOneByStatus(string $status) find object in database by status
 * @method static \Posts retrieveByStatus(string $status) retrieve object from poll by status, get it from db if not exist in poll

 * @method void setIsDraft(integer $is_draft) set is_draft value
 * @method integer getIsDraft() get is_draft value
 * @method static \Posts[] findByIsDraft(integer $is_draft) find objects in database by is_draft
 * @method static \Posts findOneByIsDraft(integer $is_draft) find object in database by is_draft
 * @method static \Posts retrieveByIsDraft(integer $is_draft) retrieve object from poll by is_draft, get it from db if not exist in poll

 * @method void setAuthor(string $author) set author value
 * @method string getAuthor() get author value
 * @method static \Posts[] findByAuthor(string $author) find objects in database by author
 * @method static \Posts findOneByAuthor(string $author) find object in database by author
 * @method static \Posts retrieveByAuthor(string $author) retrieve object from poll by author, get it from db if not exist in poll

 * @method void setTaxonomy(string $taxonomy) set taxonomy value
 * @method string getTaxonomy() get taxonomy value
 * @method static \Posts[] findByTaxonomy(string $taxonomy) find objects in database by taxonomy
 * @method static \Posts findOneByTaxonomy(string $taxonomy) find object in database by taxonomy
 * @method static \Posts retrieveByTaxonomy(string $taxonomy) retrieve object from poll by taxonomy, get it from db if not exist in poll

 * @method void setLanguage(string $language) set language value
 * @method string getLanguage() get language value
 * @method static \Posts[] findByLanguage(string $language) find objects in database by language
 * @method static \Posts findOneByLanguage(string $language) find object in database by language
 * @method static \Posts retrieveByLanguage(string $language) retrieve object from poll by language, get it from db if not exist in poll

 * @method void setOrdering(integer $ordering) set ordering value
 * @method integer getOrdering() get ordering value
 * @method static \Posts[] findByOrdering(integer $ordering) find objects in database by ordering
 * @method static \Posts findOneByOrdering(integer $ordering) find object in database by ordering
 * @method static \Posts retrieveByOrdering(integer $ordering) retrieve object from poll by ordering, get it from db if not exist in poll

 * @method void setHits(integer $hits) set hits value
 * @method integer getHits() get hits value
 * @method static \Posts[] findByHits(integer $hits) find objects in database by hits
 * @method static \Posts findOneByHits(integer $hits) find object in database by hits
 * @method static \Posts retrieveByHits(integer $hits) retrieve object from poll by hits, get it from db if not exist in poll

 * @method void setIsPin(integer $is_pin) set is_pin value
 * @method integer getIsPin() get is_pin value
 * @method static \Posts[] findByIsPin(integer $is_pin) find objects in database by is_pin
 * @method static \Posts findOneByIsPin(integer $is_pin) find object in database by is_pin
 * @method static \Posts retrieveByIsPin(integer $is_pin) retrieve object from poll by is_pin, get it from db if not exist in poll

 * @method void setModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) setModifiedTime(string $modified_time) set modified_time value
 * @method \Flywheel\Db\Type\DateTime getModifiedTime() get modified_time value
 * @method static \Posts[] findByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \Posts findOneByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findOneByModifiedTime(string $modified_time) find object in database by modified_time
 * @method static \Posts retrieveByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) retrieveByModifiedTime(string $modified_time) retrieve object from poll by modified_time, get it from db if not exist in poll

 * @method void setCreatedTime(\Flywheel\Db\Type\DateTime $created_time) setCreatedTime(string $created_time) set created_time value
 * @method \Flywheel\Db\Type\DateTime getCreatedTime() get created_time value
 * @method static \Posts[] findByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \Posts findOneByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \Posts retrieveByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) retrieveByCreatedTime(string $created_time) retrieve object from poll by created_time, get it from db if not exist in poll

 * @method void setPublishTime(\Flywheel\Db\Type\DateTime $publish_time) setPublishTime(string $publish_time) set publish_time value
 * @method \Flywheel\Db\Type\DateTime getPublishTime() get publish_time value
 * @method static \Posts[] findByPublishTime(\Flywheel\Db\Type\DateTime $publish_time) findByPublishTime(string $publish_time) find objects in database by publish_time
 * @method static \Posts findOneByPublishTime(\Flywheel\Db\Type\DateTime $publish_time) findOneByPublishTime(string $publish_time) find object in database by publish_time
 * @method static \Posts retrieveByPublishTime(\Flywheel\Db\Type\DateTime $publish_time) retrieveByPublishTime(string $publish_time) retrieve object from poll by publish_time, get it from db if not exist in poll


 */
abstract class PostsBase extends ActiveRecord {
    protected static $_tableName = 'posts';
    protected static $_phpName = 'Posts';
    protected static $_pk = 'id';
    protected static $_alias = 'p';
    protected static $_dbConnectName = 'posts';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'title' => array('name' => 'title',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'term_id' => array('name' => 'term_id',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'slug' => array('name' => 'slug',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'excerpt' => array('name' => 'excerpt',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'text'),
        'content' => array('name' => 'content',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'text'),
        'status' => array('name' => 'status',
                'default' => 'PUBLISH',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(20)',
                'length' => 20),
        'is_draft' => array('name' => 'is_draft',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'author' => array('name' => 'author',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'taxonomy' => array('name' => 'taxonomy',
                'default' => 'post',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(100)',
                'length' => 100),
        'language' => array('name' => 'language',
                'default' => '*',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(20)',
                'length' => 20),
        'ordering' => array('name' => 'ordering',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'hits' => array('name' => 'hits',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'is_pin' => array('name' => 'is_pin',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'modified_time' => array('name' => 'modified_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'created_time' => array('name' => 'created_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'publish_time' => array('name' => 'publish_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
     );
    protected static $_validate = array(
    );
    protected static $_validatorRules = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','title','term_id','slug','excerpt','content','status','is_draft','author','taxonomy','language','ordering','hits','is_pin','modified_time','created_time','publish_time');

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