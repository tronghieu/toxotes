<?php
require_once __DIR__ .'/../vendor/autoload.php';
$captcha = new \Flywheel\Captcha\Math();
$captcha->limit = 20;
$captcha->show();