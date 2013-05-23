<?php
define('APP_DIR', dirname(__FILE__) .'/../');
return array(
    'app_path' => APP_DIR,
    'import' => array(
        'global.model.*',
        'global.model_mongo.*',
        'global.events.*',
        'app.include.*',
        'global.include.*',
    ),
    'timezone' => 'Asia/Ho_Chi_Minh',
);