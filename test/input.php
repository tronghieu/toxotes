<?php
require __DIR__ .'./../bootstrap.php';
$r = \Flywheel\Filter\Input::clean("9,12", 'FLOAT');

var_dump(preg_match("#[0-9]{1,3}\.[0-9]{2}#", "9,12", $matches));
var_dump($matches);

var_dump($r);