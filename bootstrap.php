<?php
define('ROOT_PATH', dirname(__FILE__));
define('GLOBAL_PATH', ROOT_PATH .DIRECTORY_SEPARATOR .'global');
define('LIBRARY_PATH', ROOT_PATH .DIRECTORY_SEPARATOR .'library');
define('RUNTIME_PATH', ROOT_PATH .DIRECTORY_SEPARATOR .'runtime');
define('EVENT_CONSUMER_NAME', 'CORE_BILLING');

require_once LIBRARY_PATH .'/Flywheel/Loader.php';
\Flywheel\Loader::register();
\Flywheel\Loader::setPathOfAlias('global', GLOBAL_PATH);
\Flywheel\Loader::setPathOfAlias('library', LIBRARY_PATH);