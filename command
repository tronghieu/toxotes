#!/usr/bin/env php
<?php
chdir(dirname(__FILE__));
require_once './bootstrap.php';

defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));
try {
	$cli = new \Flywheel\Cli();
	$cli->run($_SERVER['argv']);
}
catch (\Exception $ce) {
	print_r($ce->getMessage() .' at ' .$ce->getFile() .$ce->getLine());
    $ce->getTraceAsString();
}