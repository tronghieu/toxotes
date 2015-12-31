<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Items
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11) unsigned
 * @property integer $pin pin type : tinyint(1)
 * @property integer $cat_id cat_id type : int(11)
 * @property string $slug slug type : varchar(255) max_length : 255
 * @property string $name name type : varchar(255) max_length : 255
 * @property string $status status type : enum('ACTIVE','INACTIVE') max_length : 8
 * @property string $sku sku type : varchar(255) max_length : 255
 * @property number $regular_price regular_price type : double(20,2)
 * @property number $sale_price sale_price type : double(20,2)
 * @property string $purchase_note purchase_note type : varchar(255) max_length : 255
 * @property string $excerpt excerpt type : tinytext max_length : 
 * @property string $description description type : text max_length : 
 * @property string $imgs imgs type : text max_length : 
 * @property integer $stock_quantity stock_quantity type : int(11)
 * @property string $stock_status stock_status type : enum('IN_STOCK','OUT_OF_STOCK') max_length : 12
 * @property integer $stock_manage stock_manage type : tinyint(1)
 * @property string $back_order back_order type : enum('NOT_ALLOW','ALLOW','ALLOW_NOTIFY') max_length : 12
 * @property integer $promotion promotion type : tinyint(4)
 * @property string $promotion_desc promotion_desc type : tinytext max_length : 
 * @property integer $is_draft is_draft type : tinyint(1)
 * @property datetime $sale_to_time sale_to_time type : datetime
 * @property datetime $sale_from_time sale_from_time type : datetime
 * @property datetime $public_time public_time type : datetime
 * @property datetime $expire_time expire_time type : datetime
 * @property datetime $created_time created_time type : datetime
 * @property datetime $modified_time modified_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Items[] findById(integer $id) find objects in database by id
 * @method static \Items findOneById(integer $id) find object in database by id
 * @method static \Items retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setPin(integer $pin) set pin value
 * @method integer getPin() get pin value
 * @method static \Items[] findByPin(integer $pin) find objects in database by pin
 * @method static \Items findOneByPin(integer $pin) find object in database by pin
 * @method static \Items retrieveByPin(integer $pin) retrieve object from poll by pin, get it from db if not exist in poll

 * @method void setCatId(integer $cat_id) set cat_id value
 * @method integer getCatId() get cat_id value
 * @method static \Items[] findByCatId(integer $cat_id) find objects in database by cat_id
 * @method static \Items findOneByCatId(integer $cat_id) find object in database by cat_id
 * @method static \Items retrieveByCatId(integer $cat_id) retrieve object from poll by cat_id, get it from db if not exist in poll

 * @method void setSlug(string $slug) set slug value
 * @method string getSlug() get slug value
 * @method static \Items[] findBySlug(string $slug) find objects in database by slug
 * @method static \Items findOneBySlug(string $slug) find object in database by slug
 * @method static \Items retrieveBySlug(string $slug) retrieve object from poll by slug, get it from db if not exist in poll

 * @method void setName(string $name) set name value
 * @method string getName() get name value
 * @method static \Items[] findByName(string $name) find objects in database by name
 * @method static \Items findOneByName(string $name) find object in database by name
 * @method static \Items retrieveByName(string $name) retrieve object from poll by name, get it from db if not exist in poll

 * @method void setStatus(string $status) set status value
 * @method string getStatus() get status value
 * @method static \Items[] findByStatus(string $status) find objects in database by status
 * @method static \Items findOneByStatus(string $status) find object in database by status
 * @method static \Items retrieveByStatus(string $status) retrieve object from poll by status, get it from db if not exist in poll

 * @method void setSku(string $sku) set sku value
 * @method string getSku() get sku value
 * @method static \Items[] findBySku(string $sku) find objects in database by sku
 * @method static \Items findOneBySku(string $sku) find object in database by sku
 * @method static \Items retrieveBySku(string $sku) retrieve object from poll by sku, get it from db if not exist in poll

 * @method void setRegularPrice(number $regular_price) set regular_price value
 * @method number getRegularPrice() get regular_price value
 * @method static \Items[] findByRegularPrice(number $regular_price) find objects in database by regular_price
 * @method static \Items findOneByRegularPrice(number $regular_price) find object in database by regular_price
 * @method static \Items retrieveByRegularPrice(number $regular_price) retrieve object from poll by regular_price, get it from db if not exist in poll

 * @method void setSalePrice(number $sale_price) set sale_price value
 * @method number getSalePrice() get sale_price value
 * @method static \Items[] findBySalePrice(number $sale_price) find objects in database by sale_price
 * @method static \Items findOneBySalePrice(number $sale_price) find object in database by sale_price
 * @method static \Items retrieveBySalePrice(number $sale_price) retrieve object from poll by sale_price, get it from db if not exist in poll

 * @method void setPurchaseNote(string $purchase_note) set purchase_note value
 * @method string getPurchaseNote() get purchase_note value
 * @method static \Items[] findByPurchaseNote(string $purchase_note) find objects in database by purchase_note
 * @method static \Items findOneByPurchaseNote(string $purchase_note) find object in database by purchase_note
 * @method static \Items retrieveByPurchaseNote(string $purchase_note) retrieve object from poll by purchase_note, get it from db if not exist in poll

 * @method void setExcerpt(string $excerpt) set excerpt value
 * @method string getExcerpt() get excerpt value
 * @method static \Items[] findByExcerpt(string $excerpt) find objects in database by excerpt
 * @method static \Items findOneByExcerpt(string $excerpt) find object in database by excerpt
 * @method static \Items retrieveByExcerpt(string $excerpt) retrieve object from poll by excerpt, get it from db if not exist in poll

 * @method void setDescription(string $description) set description value
 * @method string getDescription() get description value
 * @method static \Items[] findByDescription(string $description) find objects in database by description
 * @method static \Items findOneByDescription(string $description) find object in database by description
 * @method static \Items retrieveByDescription(string $description) retrieve object from poll by description, get it from db if not exist in poll

 * @method void setImgs(string $imgs) set imgs value
 * @method string getImgs() get imgs value
 * @method static \Items[] findByImgs(string $imgs) find objects in database by imgs
 * @method static \Items findOneByImgs(string $imgs) find object in database by imgs
 * @method static \Items retrieveByImgs(string $imgs) retrieve object from poll by imgs, get it from db if not exist in poll

 * @method void setStockQuantity(integer $stock_quantity) set stock_quantity value
 * @method integer getStockQuantity() get stock_quantity value
 * @method static \Items[] findByStockQuantity(integer $stock_quantity) find objects in database by stock_quantity
 * @method static \Items findOneByStockQuantity(integer $stock_quantity) find object in database by stock_quantity
 * @method static \Items retrieveByStockQuantity(integer $stock_quantity) retrieve object from poll by stock_quantity, get it from db if not exist in poll

 * @method void setStockStatus(string $stock_status) set stock_status value
 * @method string getStockStatus() get stock_status value
 * @method static \Items[] findByStockStatus(string $stock_status) find objects in database by stock_status
 * @method static \Items findOneByStockStatus(string $stock_status) find object in database by stock_status
 * @method static \Items retrieveByStockStatus(string $stock_status) retrieve object from poll by stock_status, get it from db if not exist in poll

 * @method void setStockManage(integer $stock_manage) set stock_manage value
 * @method integer getStockManage() get stock_manage value
 * @method static \Items[] findByStockManage(integer $stock_manage) find objects in database by stock_manage
 * @method static \Items findOneByStockManage(integer $stock_manage) find object in database by stock_manage
 * @method static \Items retrieveByStockManage(integer $stock_manage) retrieve object from poll by stock_manage, get it from db if not exist in poll

 * @method void setBackOrder(string $back_order) set back_order value
 * @method string getBackOrder() get back_order value
 * @method static \Items[] findByBackOrder(string $back_order) find objects in database by back_order
 * @method static \Items findOneByBackOrder(string $back_order) find object in database by back_order
 * @method static \Items retrieveByBackOrder(string $back_order) retrieve object from poll by back_order, get it from db if not exist in poll

 * @method void setPromotion(integer $promotion) set promotion value
 * @method integer getPromotion() get promotion value
 * @method static \Items[] findByPromotion(integer $promotion) find objects in database by promotion
 * @method static \Items findOneByPromotion(integer $promotion) find object in database by promotion
 * @method static \Items retrieveByPromotion(integer $promotion) retrieve object from poll by promotion, get it from db if not exist in poll

 * @method void setPromotionDesc(string $promotion_desc) set promotion_desc value
 * @method string getPromotionDesc() get promotion_desc value
 * @method static \Items[] findByPromotionDesc(string $promotion_desc) find objects in database by promotion_desc
 * @method static \Items findOneByPromotionDesc(string $promotion_desc) find object in database by promotion_desc
 * @method static \Items retrieveByPromotionDesc(string $promotion_desc) retrieve object from poll by promotion_desc, get it from db if not exist in poll

 * @method void setIsDraft(integer $is_draft) set is_draft value
 * @method integer getIsDraft() get is_draft value
 * @method static \Items[] findByIsDraft(integer $is_draft) find objects in database by is_draft
 * @method static \Items findOneByIsDraft(integer $is_draft) find object in database by is_draft
 * @method static \Items retrieveByIsDraft(integer $is_draft) retrieve object from poll by is_draft, get it from db if not exist in poll

 * @method void setSaleToTime(\Flywheel\Db\Type\DateTime $sale_to_time) setSaleToTime(string $sale_to_time) set sale_to_time value
 * @method \Flywheel\Db\Type\DateTime getSaleToTime() get sale_to_time value
 * @method static \Items[] findBySaleToTime(\Flywheel\Db\Type\DateTime $sale_to_time) findBySaleToTime(string $sale_to_time) find objects in database by sale_to_time
 * @method static \Items findOneBySaleToTime(\Flywheel\Db\Type\DateTime $sale_to_time) findOneBySaleToTime(string $sale_to_time) find object in database by sale_to_time
 * @method static \Items retrieveBySaleToTime(\Flywheel\Db\Type\DateTime $sale_to_time) retrieveBySaleToTime(string $sale_to_time) retrieve object from poll by sale_to_time, get it from db if not exist in poll

 * @method void setSaleFromTime(\Flywheel\Db\Type\DateTime $sale_from_time) setSaleFromTime(string $sale_from_time) set sale_from_time value
 * @method \Flywheel\Db\Type\DateTime getSaleFromTime() get sale_from_time value
 * @method static \Items[] findBySaleFromTime(\Flywheel\Db\Type\DateTime $sale_from_time) findBySaleFromTime(string $sale_from_time) find objects in database by sale_from_time
 * @method static \Items findOneBySaleFromTime(\Flywheel\Db\Type\DateTime $sale_from_time) findOneBySaleFromTime(string $sale_from_time) find object in database by sale_from_time
 * @method static \Items retrieveBySaleFromTime(\Flywheel\Db\Type\DateTime $sale_from_time) retrieveBySaleFromTime(string $sale_from_time) retrieve object from poll by sale_from_time, get it from db if not exist in poll

 * @method void setPublicTime(\Flywheel\Db\Type\DateTime $public_time) setPublicTime(string $public_time) set public_time value
 * @method \Flywheel\Db\Type\DateTime getPublicTime() get public_time value
 * @method static \Items[] findByPublicTime(\Flywheel\Db\Type\DateTime $public_time) findByPublicTime(string $public_time) find objects in database by public_time
 * @method static \Items findOneByPublicTime(\Flywheel\Db\Type\DateTime $public_time) findOneByPublicTime(string $public_time) find object in database by public_time
 * @method static \Items retrieveByPublicTime(\Flywheel\Db\Type\DateTime $public_time) retrieveByPublicTime(string $public_time) retrieve object from poll by public_time, get it from db if not exist in poll

 * @method void setExpireTime(\Flywheel\Db\Type\DateTime $expire_time) setExpireTime(string $expire_time) set expire_time value
 * @method \Flywheel\Db\Type\DateTime getExpireTime() get expire_time value
 * @method static \Items[] findByExpireTime(\Flywheel\Db\Type\DateTime $expire_time) findByExpireTime(string $expire_time) find objects in database by expire_time
 * @method static \Items findOneByExpireTime(\Flywheel\Db\Type\DateTime $expire_time) findOneByExpireTime(string $expire_time) find object in database by expire_time
 * @method static \Items retrieveByExpireTime(\Flywheel\Db\Type\DateTime $expire_time) retrieveByExpireTime(string $expire_time) retrieve object from poll by expire_time, get it from db if not exist in poll

 * @method void setCreatedTime(\Flywheel\Db\Type\DateTime $created_time) setCreatedTime(string $created_time) set created_time value
 * @method \Flywheel\Db\Type\DateTime getCreatedTime() get created_time value
 * @method static \Items[] findByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \Items findOneByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \Items retrieveByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) retrieveByCreatedTime(string $created_time) retrieve object from poll by created_time, get it from db if not exist in poll

 * @method void setModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) setModifiedTime(string $modified_time) set modified_time value
 * @method \Flywheel\Db\Type\DateTime getModifiedTime() get modified_time value
 * @method static \Items[] findByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \Items findOneByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findOneByModifiedTime(string $modified_time) find object in database by modified_time
 * @method static \Items retrieveByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) retrieveByModifiedTime(string $modified_time) retrieve object from poll by modified_time, get it from db if not exist in poll


 */
abstract class ItemsBase extends ActiveRecord {
    protected static $_tableName = 'items';
    protected static $_phpName = 'Items';
    protected static $_pk = 'id';
    protected static $_alias = 'i';
    protected static $_dbConnectName = 'items';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11) unsigned',
                'length' => 4),
        'pin' => array('name' => 'pin',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'cat_id' => array('name' => 'cat_id',
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'slug' => array('name' => 'slug',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'name' => array('name' => 'name',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'status' => array('name' => 'status',
                'default' => 'ACTIVE',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'ACTIVE\',\'INACTIVE\')',
                'length' => 8),
        'sku' => array('name' => 'sku',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'regular_price' => array('name' => 'regular_price',
                'default' => 0.00,
                'not_null' => true,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'double(20,2)',
                'length' => 20),
        'sale_price' => array('name' => 'sale_price',
                'default' => 0.00,
                'not_null' => true,
                'type' => 'number',
                'auto_increment' => false,
                'db_type' => 'double(20,2)',
                'length' => 20),
        'purchase_note' => array('name' => 'purchase_note',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'varchar(255)',
                'length' => 255),
        'excerpt' => array('name' => 'excerpt',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'tinytext'),
        'description' => array('name' => 'description',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'imgs' => array('name' => 'imgs',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'text'),
        'stock_quantity' => array('name' => 'stock_quantity',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'int(11)',
                'length' => 4),
        'stock_status' => array('name' => 'stock_status',
                'default' => 'IN_STOCK',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'IN_STOCK\',\'OUT_OF_STOCK\')',
                'length' => 12),
        'stock_manage' => array('name' => 'stock_manage',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'back_order' => array('name' => 'back_order',
                'default' => 'NOT_ALLOW',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'enum(\'NOT_ALLOW\',\'ALLOW\',\'ALLOW_NOTIFY\')',
                'length' => 12),
        'promotion' => array('name' => 'promotion',
                'default' => 0,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(4)',
                'length' => 1),
        'promotion_desc' => array('name' => 'promotion_desc',
                'not_null' => true,
                'type' => 'string',
                'db_type' => 'tinytext'),
        'is_draft' => array('name' => 'is_draft',
                'default' => 1,
                'not_null' => true,
                'type' => 'integer',
                'auto_increment' => false,
                'db_type' => 'tinyint(1)',
                'length' => 1),
        'sale_to_time' => array('name' => 'sale_to_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'sale_from_time' => array('name' => 'sale_from_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'public_time' => array('name' => 'public_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'expire_time' => array('name' => 'expire_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'created_time' => array('name' => 'created_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'modified_time' => array('name' => 'modified_time',
                'default' => '0000-00-00 00:00:00',
                'not_null' => true,
                'type' => 'datetime',
                'db_type' => 'datetime'),
     );
    protected static $_validate = array(
        'status' => array(
            array('name' => 'ValidValues',
                'value' => 'ACTIVE|INACTIVE',
                'message'=> 'status\'s values is not allowed'
            ),
        ),
        'stock_status' => array(
            array('name' => 'ValidValues',
                'value' => 'IN_STOCK|OUT_OF_STOCK',
                'message'=> 'stock status\'s values is not allowed'
            ),
        ),
        'back_order' => array(
            array('name' => 'ValidValues',
                'value' => 'NOT_ALLOW|ALLOW|ALLOW_NOTIFY',
                'message'=> 'back order\'s values is not allowed'
            ),
        ),
    );
    protected static $_validatorRules = array(
        'status' => array(
            array('name' => 'ValidValues',
                'value' => 'ACTIVE|INACTIVE',
                'message'=> 'status\'s values is not allowed'
            ),
        ),
        'stock_status' => array(
            array('name' => 'ValidValues',
                'value' => 'IN_STOCK|OUT_OF_STOCK',
                'message'=> 'stock status\'s values is not allowed'
            ),
        ),
        'back_order' => array(
            array('name' => 'ValidValues',
                'value' => 'NOT_ALLOW|ALLOW|ALLOW_NOTIFY',
                'message'=> 'back order\'s values is not allowed'
            ),
        ),
    );
    protected static $_init = false;
    protected static $_cols = array('id','pin','cat_id','slug','name','status','sku','regular_price','sale_price','purchase_note','excerpt','description','imgs','stock_quantity','stock_status','stock_manage','back_order','promotion','promotion_desc','is_draft','sale_to_time','sale_from_time','public_time','expire_time','created_time','modified_time');

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