<?php
namespace Toxotes;

use Flywheel\Exception;
use Flywheel\Object;

class Plugin extends Object {
    public static $filter = array();
    public static $taxonomy = array();

    public static function registerTaxonomy() {}

    public static function listen($eventName, $listener) {
        self::getEventDispatcher()->addListener($eventName, $listener);
    }

    public static function addFilter($tag, $callback, $priority = 1, $acceptedArgs = 1) {
        $uk = self::buildFilterUk($tag, $callback, $priority);
        self::$filter[$tag][$priority][$uk] = array('callback' => $callback, 'accepted_args' => $acceptedArgs);
    }

    public static function doAction($tag, $arg = '') {
        if (!isset(self::$filter[$tag])) {
            return;
        }

        $args = array();
        if ( is_array($arg) && 1 == count($arg) && isset($arg[0]) && is_object($arg[0])) // array(&$this)
        {
            $args[] =& $arg[0];
        } else {
            $args[] = $arg;
        }

        for ( $a = 2; $a < func_num_args(); $a++ ) {
            $args[] = func_get_arg($a);
        }

        reset(self::$filter[$tag]);

        do {
            foreach ( (array) current(self::$filter[$tag]) as $filter)
                if ( !is_null($filter['callback']) )
                {
                    call_user_func_array($filter['callback'], array_slice($args, 0, (int) $filter['accepted_args']));
                }

        } while (next(self::$filter[$tag]) !== false);
    }

    public static function applyFilters($tag, $value = null) {
        if (!isset(self::$filter[$tag])) {
            return $value;
        }

        $args = array();

        reset(self::$filter[$tag]);

        if ( empty($args) )
            $args = func_get_args();

        do {
            foreach( (array) current(self::$filter[$tag]) as $filter )
                if ( !is_null($filter['callback']) ){
                    $args[1] = $value;
                    $value = call_user_func_array($filter['callback'], array_slice($args, 1, (int) $filter['accepted_args']));
                }

        } while ( next(self::$filter[$tag]) !== false );

        return $value;
    }

    public static function buildFilterUk($tag, $callback, $priority) {
        static $filter_id_count = 0;

        if (is_string($callback)) {
            return $callback;
        }

        if ( is_object($callback) ) {
            // Closures are currently implemented as objects
            $callback = array( $callback, '' );
        } else {
            $callback = (array) $callback;
        }

        if (is_string($callback[0])) {
            return $callback[0].$callback[1];
        } else if (is_object($callback[0])) {
            $obj_idx = get_class($callback[0]).$callback[1];

            $obj_idx .= isset(self::$filter[$tag][$priority]) ?
                            count((array)self::$filter[$tag][$priority])
                            : $filter_id_count;
            ++$filter_id_count;
            return $obj_idx;
        }

        throw new \Exception('Not support callback');
    }
}