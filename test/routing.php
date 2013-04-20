<?php
require __DIR__ .'/../bootstrap.php';
$globalCnf = require GLOBAL_PATH . '/config/config.cfg.php';
$config = array_merge( $globalCnf, require __DIR__ .'/../apps/backend/config/main.cfg.php');
use \Flywheel\Base;
try {
    $app = \Flywheel\Base::createWebApp($config, \Flywheel\Base::ENV_DEV, true);
    /** @var \Flywheel\Router\WebRouter $router */
    $router = \Flywheel\Factory::getRouter();
    var_dump($router->createUrl('dashboard/default', array('a' => 1, 'b' => 'c')));
    var_dump($router->createUrl('login', array('r' => 'abc')));
    var_dump($router->createUrl('logout'));
    var_dump($router->createUrl('account/detail', array('id' => 1, 'sort' => 'id')));
    var_dump($router->createUrl('account/detail', array('key' => 'acb')));
} catch (\Exception $e) {
    \Flywheel\Exception::printExceptionInfo($e);
}