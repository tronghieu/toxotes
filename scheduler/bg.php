<?php
use Flywheel\Base;

chdir(__DIR__);
set_time_limit(36000);
require __DIR__ .'/../bootstrap.php';
$globalCnf = require GLOBAL_PATH . '/config/config.cfg.php';
$config = array_merge($globalCnf, require __DIR__ .'/../apps/background/config/main.cfg.php');
try {
    Base::createConsoleApp($config, Base::ENV_DEV, true)->run();
} catch (Exception $e) {
    error_log($e->getMessage() .' at ' .$e->getFile() .' in ' .$e->getLine(). "\nTrace:" .$e->getTraceAsString());
}