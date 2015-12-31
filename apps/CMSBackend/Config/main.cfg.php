<?php
defined('APP_PATH') or define('APP_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
defined('APP_RESOURCES_PATH') or define('APP_RESOURCES_PATH', APP_PATH .'Resources' .DIRECTORY_SEPARATOR);
\Flywheel\Loader::addNamespace('CMSBackend', dirname(APP_PATH));

return array(
    'i18n' => [
        'default_locale' => 'en-GB',
        'resource' => [
            'vi-VN' => [APP_RESOURCES_PATH .'i18n/vi-VN/messages.yml'],
            'en-GB' => [APP_RESOURCES_PATH .'i18n/en-GB/messages.yml']
        ]
    ],
    'app_name' => 'CMSBackend',
    'app_path' => APP_PATH,
    'view_path' => APP_PATH . DIRECTORY_SEPARATOR . 'Template/',
    'import' => array(
        'app.Library.*',
        'app.Controller.*',
        'root.model.*'
    ),
    'editor' => 'app.Widget.Editor.SummerNote',
    'namespace' => 'CMSBackend',
    'timezone' => 'Asia/Ho_Chi_Minh',
    'template' => 'Flat',
    'css_version' => '1.2',
    'js_version' => '1.2'
);