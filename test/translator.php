<?php

use Flywheel\Base;
use Symfony\Component\Translation\Loader\PhpFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Loader\ArrayLoader;

require_once __DIR__ .'/../bootstrap.php';

try {
    $globalCnf = require GLOBAL_PATH . '/config/config.cfg.php';
    $config = array_merge( $globalCnf, require __DIR__ . '/../apps/Frontend/config/main.cfg.php');
    $app = Base::createWebApp($config, Base::ENV_DEV, true);
    td('View more', array(), 'messages', 'vi-VN');
    echo \Flywheel\Factory::getTranslator()->trans('View more', array(), 'messages', 'vi-VN');
} catch (\Exception $e) {
    print_r($e);
}