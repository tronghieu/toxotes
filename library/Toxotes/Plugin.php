<?php
namespace Toxotes;

use Flywheel\Object;

class Plugin extends Object {
    public static function listen($eventName, $listener) {
        self::getEventDispatcher()->addListener($eventName, $listener);
    }
}