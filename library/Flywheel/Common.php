<?php
use Flywheel\Factory;

if (false == function_exists('array_zip')) {
    function array_zip() {
        $args = func_get_args();
        $zipped = array();
        $n = count($args);
        for ($i=0; $i<$n; ++$i) {
            reset($args[$i]);
        }
        while ($n) {
            $tmp = array();
            for ($i=0; $i<$n; ++$i) {
                if (key($args[$i]) === null) {
                    break 2;
                }
                $tmp[] = current($args[$i]);
                next($args[$i]);
            }
            $zipped[] = $tmp;
        }
        return $zipped;
    }
}

function t($id, array $parameters = array(), $domain = 'messages', $locale = null) {
    return $id;
    return $translator = Factory::getTranslator();
}