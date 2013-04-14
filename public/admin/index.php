<?php
require __DIR__ .'/../../bootstrap.php';
$globalCnf = require GLOBAL_PATH . '/config/config.cfg.php';
$config = array_merge( $globalCnf, require __DIR__ .'/../../apps/backend/config/main.cfg.php');
use \Flywheel\Base;
try {
    $app = \Flywheel\Base::createWebApp($config, \Flywheel\Base::ENV_DEV, true);
    $app->run();
} catch (\Exception $e) {
    //    Ming_Exception::printExceptionInfo($e);
    print_r($e);
}