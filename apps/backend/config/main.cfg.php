<?php
defined('APP_PATH') or define('APP_PATH', dirname(dirname(__FILE__))) .DIRECTORY_SEPARATOR;
return array(
	'app_path'=> APP_PATH,
	'view_path' => APP_PATH .DIRECTORY_SEPARATOR .'templates/',
	'import' => array(
		'global.model.*', //if application don't use global models can redefine self model path
		'global.model_mongo.*',
		'global.include.*',
		'app.include.*',
	),
	'factory' => array(),
	'timezone' => 'Asia/Ho_Chi_Minh',
	'template' => 'default'
);