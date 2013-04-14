<?php
use Flywheel\Db\Manager;

class PolicyConfigPeer
{
    const VOUCHER_EXPIRE_SECOND = 'voucher_expire_second';
    const TRANSACTION_EXPIRE_SECOND = 'transaction_expire_second';
    const MAX_WITHDRAW_AMOUNT = 'max_withdraw_amount';
    const LIMIT_WITHDRAW_PER_DAY = 'limit_withdraw_per_day';
    const LIMIT_TRANSFER_PER_DAY = 'limit_transfer_per_day';
    const MINIMUM_BALANCE = 'minimum_balance';
    const MAX_TRANSFER_AMOUNT = 'max_transfer_amount';

    private static $_pool = array();

    public static function read($key) {
        // @TODO Can make it better for performance with shorter SQL and check by PHP code
        $conf = PolicyConfig::read()
            ->where('`key` = ?')
            ->andWhere('(CURTIME() BETWEEN `valid_time` AND `invalid_time`) OR (TIMEDIFF(NOW(), `valid_time` ) >=0 AND (`invalid_time` IS NULL OR `invalid_time` = "0000-00-00 00:00:00"))')
            ->orderBy('`valid_time`', 'DESC')
            ->setMaxResults(1)
            ->setParameter(1, $key, \PDO::PARAM_STR)
            ->execute()
            ->fetch(\PDO::FETCH_ASSOC);
        if (!$conf)
            return false;

        switch ($conf['type']) {
            case 'STRING':
                return (string) $conf['string_value'];
                break;
            case 'NUMBER':
                return $conf['number_value'];
                break;
            case 'BOOLEAN':
                return (bool) $conf['boolean_value'];
                break;
            case 'ENUM' :
                return explode(',' , $conf['enum_value']);
                break;
        }
    }

    public static function get($key) {
        $key = strtolower($key);
        if (!isset(self::$_pool[$key]) || null == self::$_pool[$key]) {
            $val = self::read($key);
            if (!$val)
                return false;

            self::$_pool[$key] = $val;
        }

        return self::$_pool[$key];
    }
}
