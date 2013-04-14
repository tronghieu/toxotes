<?php
require_once __DIR__ .'./../bootstrap.php';
try {
    \Flywheel\Factory::getQueue('api');
} catch (\Exception $e) {
    var_dump($e);
}