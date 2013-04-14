<?php
chdir(__DIR__);
include_once __DIR__ .'/../bootstrap.php';
try {
    $redis = \Flywheel\Redis\RedisClient::getConnection('default');
    var_dump($redis->ping());

    $redis = new Redis();
    $redis->connect('192.168.50.62', 6379);
    var_dump($redis->ping());

} catch (\Exception $e) {
    var_dump($e);
}