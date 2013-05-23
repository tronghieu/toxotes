<?php
use Flywheel\Loader;
use Toxotes\Plugin;

Loader::import('root.extension.plugin.simple_event.*');

$info = array(
    'name' => 'Simple Event',
    'author_name' => 'Lưu Trọng Hiếu',
    'author_email' => 'tronghieu.luu@gmail.com'
);

$simpleEvent = new SimpleEvent();

Plugin::listen('onAfterInitAdminMenu', array($simpleEvent, 'addMenu'));

return $info;