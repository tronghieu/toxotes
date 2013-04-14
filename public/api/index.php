<?php
require __DIR__ .'/../../bootstrap.php';
$globalCnf = require GLOBAL_PATH . '/config/config.cfg.php';
$config = array_merge( $globalCnf, require __DIR__ .'/../../apps/api/configs/main.cfg.php');
use \Flywheel\Base;
try {
    $app = Base::createApiApp($config, Base::ENV_DEV, true);
    $app->run();
} catch (\Exception $ex) {
    require_once dirname(__FILE__) . '/../../global/include/CoreApi.php';
    \CoreApi\ErrorHandler::printExceptionInfo($ex);
}