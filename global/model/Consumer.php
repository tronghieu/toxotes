<?php
use Flywheel\Redis\RedisClient;

/**
 * Consumer
 *  This class has been auto-generated at 14/12/2012 23:30:49
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/ConsumerBase.php';
class Consumer extends \ConsumerBase {

    const STATUS_ACTIVE = 1,
        STATUS_INACTIVE = 0;

    protected function _afterSave() {
        parent::_afterSave();
        self::_addToCache($this, $this->key);
    }

    /**
     * @param $consumer_key
     * @return bool|\Consumer
     */
    public static function retrieveByKey($consumer_key)
    {
        if (null == $consumer_key)
            return false;

        if (null != ($obj = (self::getInstanceFromPool($consumer_key))))
            return $obj;

        if (null != ($obj = (self::retrieveFromCache($consumer_key))))
            return $obj;

        $obj = self::findOneByKey($consumer_key);
        if ($obj) {
            self::addInstanceToPool($obj, $obj->key);
            self::_addToCache($obj, $obj->key);
        }

        return $obj;
    }

    protected function _beforeSave() {
        if ($this->isNew()) {
            $this->key = ModelPeer::randCrc32b(26);
            $this->secret = ModelPeer::randCrc32b(56);
        }
    }

    public static function retrieveFromCache($consumer_key) {
        if ($data = RedisClient::getConnection(self::getTableName())->get(REDIS_CONSUMER .$consumer_key)) {
            $obj = new self();
            $obj->hydrate(json_decode($data, true));
            $obj->setNew(false);
            return $obj;
        }
        return null;
    }

    /**
     * @param Consumer $obj
     * @param string $consumer_key
     * @return bool
     */
    private static function _addToCache($obj, $consumer_key) {
        return RedisClient::getConnection(self::getTableName())->set(REDIS_CONSUMER.$consumer_key, $obj->toJson());
    }
}