<?php
require __DIR__ .'/../../bootstrap.php';
$globalCnf = require GLOBAL_PATH . '/config/config.cfg.php';
$config = array_merge( $globalCnf, require __DIR__ . '/../../apps/Backend/config/main.cfg.php');
use \Flywheel\Base;
try {
    $app = \Flywheel\Base::createWebApp($config, \Flywheel\Base::ENV_DEV, true);
    $app->run();
} catch (\Flywheel\Exception\NotFound404 $ne) {
    echo "<h1>Permission Denied!</h1>You don not have permission to access this area";
    error_log($ne->getMessage());
    error_log($ne->getTraceAsString());
} catch (\Exception $e) {
    \Flywheel\Exception::printExceptionInfo($e);
}