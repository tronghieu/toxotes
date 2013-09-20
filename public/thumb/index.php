<?php
defined('WEBROOT') or define('WEBROOT', __DIR__ .'/../');
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('MUNEE_CACHE') or define('MUNEE_CACHE', __DIR__ .'/tmp/');
define('MEDIA_ROOT', __DIR__ .'/../data/');
defined('MUNEE_CHARACTER_ENCODING') or define('MUNEE_CHARACTER_ENCODING', 'utf-8');

require_once __DIR__.'/../../vendor/autoload.php';

$_GET['files'] = str_replace('tmp/', '', ltrim($_GET['files'], '/'));

echo \Munee\Dispatcher::run(
    new \Munee\Request(array(
        'image' => array(
            'checkReferrer' => false,
            'placeholders' => array(
//                '/data/*' => MEDIA_ROOT
            ),
        ),
    )));