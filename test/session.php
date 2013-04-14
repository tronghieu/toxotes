<?php
use Flywheel\Factory;

require_once __DIR__ .'/../bootstrap.php';

$globalCnf = require GLOBAL_PATH . '/config/config.cfg.php';
$config = array_merge( $globalCnf, require __DIR__ .'/../apps/backend/config/main.cfg.php');
use \Flywheel\Base;
try {
    $app = \Flywheel\Base::createWebApp($config, \Flywheel\Base::ENV_DEV, true);

    $session = Factory::getSession();

    $session->start();

    $session->setFlash('TEST', date('d/m/Y H:i:s'));

    echo $session->getFlash('TEST');

} catch (\Exception $e) {
    //    Ming_Exception::printExceptionInfo($e);
    print_r($e);
}