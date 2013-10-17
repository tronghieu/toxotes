<?php
require __DIR__ .'/../bootstrap.php';
$globalCnf = require GLOBAL_PATH . '/config/config.cfg.php';
$config = array_merge( $globalCnf, require __DIR__ . '/../apps/Frontend/config/main.cfg.php');
use \Flywheel\Base;
try {
    $app = \Flywheel\Base::createWebApp($config, \Flywheel\Base::ENV_PRO, false);
    $app->run();
} catch (\Flywheel\Exception\NotFound404 $e404){
    header('HTTP/1.0 404 Not Found');
    echo "<h1>404 KHÔNG TÌM THẤY</h1>";
    echo "Trang web bạn yêu cầu không tồn tại. Có thể bạn đã truy cập đường dẫn của phiên bản cũ.";
    exit();
} catch (\Exception $e) {
    \Flywheel\Exception::printExceptionInfo($e);
}