<?php
use Flywheel\Factory;

require_once __DIR__ .'/../bootstrap.php';
$config = require ROOT_PATH .'/apps/payment/config/main.cfg.php';
\Flywheel\Config\ConfigHandler::load('global.config.setting', 'default', true);

try {
    $app = \Flywheel\Base::createWebApp($config, \Flywheel\Base::ENV_DEV, true);
    $cookie = Factory::getCookie();
    $cookie->writeSecure('abc', 'fuck you');
    $cb = $cookie->readSecure('abc');
    var_dump($cb);
} catch (Exception $e) {
    print_r($e->getMessage());
    print_r($e->getTraceAsString());
}