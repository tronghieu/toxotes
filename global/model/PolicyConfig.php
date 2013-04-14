<?php
use Flywheel\Redis\RedisClient;

/**
 * PolicyConfig
 *  This class has been auto-generated at 20/12/2012 10:36:39
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/PolicyConfigBase.php';
class PolicyConfig extends \PolicyConfigBase {
    protected function _afterSave() {
        parent::_afterSave();
        self::_cache($this, $this->id);
//        RedisClient::getConnection(self::getTableName())->sAdd(REDIS_PCFG_KEY_GROUP.$this->key, $this->id);
    }

    /**
     * retrieve OM from cache (redis|memcached)
     * @param int $id
     * @return null|PolicyConfig
     */
    public static function retrieveFromCache($id) {
        if ($data=RedisClient::getConnection(self::getTableName())->get(REDIS_PCFG.$id)) {
            $obj = new self();
            $obj->hydrate(json_decode($data, true));
            $obj->setNew(false);
            return $obj;
        }
        return null;
    }

    public function getValue() {
        switch ($this->type) {
            case 'STRING':
                return (string) $this->string_value;
                break;
            case 'NUMBER':
                return $this->number_value;
                break;
            case 'BOOLEAN':
                return (bool) $this->boolean_value;
                break;
            case 'ENUM' :
                return explode(',' , $this->enum_value);
                break;
        }
    }

    public function checkValidTime($time_check = 'now') {
        $time_check = new DateTime($time_check);
        $valid_time = new DateTime($this->valid_time);
        if ($this->invalid_time == '0000-00-00 00:00:00')//never invalid
            $invalid_time = $time_check->add(DateInterval::createFromDateString('1 month'));
        else
            $invalid_time = new DateTime($this->invalid_time);

        if ($valid_time < $time_check AND $time_check < $invalid_time)
            return true;

        return false;
    }

    /**
     * @param PolicyConfig $pc
     * @param string $key
     * @return bool
     */
    protected static function _cache($pc, $key) {
        return RedisClient::getConnection(self::getTableName())->set(REDIS_PCFG.$key, $pc->toJSon());
    }
}