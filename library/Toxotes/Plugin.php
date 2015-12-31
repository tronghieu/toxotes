<?php
namespace Toxotes;


use Flywheel\Object;

class Plugin extends Object {
    public static $filter = array();
    public static $taxonomies = array();

    public static function registerTaxonomy($taxonomy, $namespace, $param) {
        $default = array();
        $param = array_merge_recursive($default, $param);

        $namespace = (array) $namespace;

        if (!isset($param['namespace'])) {
            $param['namespace'] = $namespace;
        }

        foreach ($namespace as $ns) {
            if (!isset(self::$taxonomies[$ns])) {
                self::$taxonomies[$ns] = array();
            }

            self::$taxonomies[$ns][$taxonomy] = $param;
        }
    }

    /**
     * register listen a event
     * @param $eventName
     * @param $listener
     */
    public static function listen($eventName, $listener) {
        self::getEventDispatcher()->addListener($eventName, $listener);
    }

    /**
     * Add filter
     * @param $tag
     * @param $callback
     * @param int $priority
     * @param int $acceptedArgs
     */
    public static function addFilter($tag, $callback, $priority = 1, $acceptedArgs = 1) {
        $uk = self::buildFilterUk($tag, $callback, $priority);
        self::$filter[$tag][$priority][$uk] = array('callback' => $callback, 'accepted_args' => $acceptedArgs);
    }

    /**
     * Doing a action
     *
     * @param $tag
     * @param string $arg
     */
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

    /**
     * Apply a filters
     * @param $tag
     * @param null $value
     * @return mixed|null
     */
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

    /**
     * Build filter uk
     *
     * @param $tag
     * @param $callback
     * @param $priority
     * @return array|string
     * @throws \Exception
     */
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

    /**
     * Get Taxonomy option
     *
     * @param $taxonomy
     * @param $object
     * @param $option
     * @param null $default
     * @return null
     */
    public static function getTaxonomyOption($taxonomy, $object, $option, $default = null) {
        if (!isset(self::$taxonomies[$object])
            || !isset(self::$taxonomies[$object][$taxonomy])
            || !isset(self::$taxonomies[$object][$taxonomy][$option])) {
            return $default;
        }

        return self::$taxonomies[$object][$taxonomy][$option];
    }
} 