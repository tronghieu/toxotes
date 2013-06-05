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
Plugin::listen('onAfterCreateTerm', array($simpleEvent, 'afterCreateTerm'));


Plugin::addFilter('custom_event_manager_page_title', function() {
    return 'Event Manager Category';
});
Plugin::addFilter('init_event_manager_term_columns', array($simpleEvent, 'customTermColumn'));

return $info;