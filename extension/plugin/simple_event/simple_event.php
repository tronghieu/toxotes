<?php
use Flywheel\Factory;
use Flywheel\Loader;
use Toxotes\Plugin;

Loader::import('root.extension.plugin.simple_event.*');

Plugin::registerTaxonomy('event_manager', 'post', array(
    'label' => t('Events')
));

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
Plugin::addFilter('default_event_manager_ordering', function($ordering) {
    return array('created_time', 'DESC');
});

Plugin::addFilter('custom_before_event_manager_post_form', array($simpleEvent, 'form'), 1, 3);
Plugin::addFilter('verify_event_manager_form_data', array($simpleEvent, 'verifyForm'));
Plugin::addFilter('handling_event_manager_form_data', array($simpleEvent, 'handlingForm'));

Plugin::addFilter('before_execute', function () {
    $doc = Factory::getDocument();
    $doc->addCss('css/plugins/gmap/gmap3-menu.css');
    $doc->addJs('event_manager/js/event_manager.js');
    $doc->addJs('http://maps.google.com/maps/api/js?sensor=false&amp;language=en');
    $doc->addJs('js/plugins/gmap/gmap3.min.js');
    $doc->addJs('js/plugins/gmap/gmap3-menu.js');
});

return $info;