<?php
set_time_limit(0);
chdir(__DIR__);
include __DIR__ .'/../../bootstrap.php';
\Flywheel\Loader::import('global.model.*');
\Flywheel\Loader::import('global.include.*');
try {
//    $acc = \Account::findOneById(15);
//    $acc->balance = 0;
//    $acc->frozen_balance = 0;
//    $acc->save();
//    exit;

    $db = \Flywheel\Db\Manager::getConnection();
    $db->executeUpdate('SET FOREIGN_KEY_CHECKS=0');
    $db->executeUpdate('DELETE FROM account WHERE id > 5000'); //keep 1000 account first
    $accounts = \Account::findAll();
    foreach ($accounts as $acc) {
        /** @var Account $acc */
        $acc->balance = 0;
        $acc->frozen_balance = 0;
        $acc->status = Account::STATUS_NORMAL;
        $acc->save();
    }

    $db->executeUpdate('UPDATE account a SET a.version=1');
//    $db->executeUpdate('TRUNCATE nonce');
    $db->executeUpdate('TRUNCATE deposit_voucher');
    $db->executeUpdate('TRUNCATE deposit_fee');
    $db->executeUpdate('TRUNCATE `transaction`');
//    $db->executeUpdate('TRUNCATE transfer_in_day');
    $db->executeUpdate('TRUNCATE withdraw_voucher');
    $db->executeUpdate('TRUNCATE withdraw_fee');
    $db->executeUpdate('TRUNCATE cos');
    $db->executeUpdate('TRUNCATE cos_data');
    $db->executeUpdate('SET FOREIGN_KEY_CHECKS=1');

    \Flywheel\Redis\RedisClient::getConnection()->flushAll();

} catch (\Exception $e) {
    echo \Flywheel\Exception::outputStackTrace($e, 'none');
}