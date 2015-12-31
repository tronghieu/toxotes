<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 1/22/15
 * Time: 11:49 AM
 */

namespace CMSBackend\Library;

class MobileMenu {
    public static $items = [];

    public static function addMenu($items)
    {
        $items = (array) $items;
        foreach($items as $i) {
            self::$items[] = $i;
        }
    }
}