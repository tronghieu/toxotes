<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 6/15/13
 * Time: 1:58 PM
 * To change this template use File | Settings | File Templates.
 */

require_once __DIR__ .'/../bootstrap.php';
$s = \Flywheel\Util\Slugify::filter('Thịt chó hà nội **2003');
var_dump($s);