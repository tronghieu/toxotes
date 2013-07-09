<?php
use Flywheel\Loader;

define('ROOT_PATH', dirname(__FILE__));
define('GLOBAL_PATH', ROOT_PATH .DIRECTORY_SEPARATOR .'global');
define('LIBRARY_PATH', ROOT_PATH .DIRECTORY_SEPARATOR .'library');
define('RUNTIME_PATH', ROOT_PATH .DIRECTORY_SEPARATOR .'runtime');
define('PUBLIC_DIR', ROOT_PATH .DIRECTORY_SEPARATOR .'public');
define('MEDIA_DIR', ROOT_PATH .DIRECTORY_SEPARATOR .'public' .DIRECTORY_SEPARATOR .'media');
define('EXTENSION_DIR', ROOT_PATH .DIRECTORY_SEPARATOR .'extension');
define('FRONTEND_DIR', ROOT_PATH .DIRECTORY_SEPARATOR.'apps/Frontend');

require_once ROOT_PATH.'/vendor/autoload.php';

//require_once LIBRARY_PATH . '/Flywheel/Common.php';
//require_once LIBRARY_PATH .'/Flywheel/Loader.php';

//add namespace before register
Loader::addNamespace('Toxotes', LIBRARY_PATH);
//Loader::addNamespace('Flywheel', LIBRARY_PATH);

Loader::register();
Loader::setPathOfAlias('root', ROOT_PATH);
Loader::setPathOfAlias('global', GLOBAL_PATH);
Loader::setPathOfAlias('library', LIBRARY_PATH);
Loader::setPathOfAlias('extension', EXTENSION_DIR);