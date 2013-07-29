<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 7/9/13
 * Time: 3:20 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Toxotes;


class Cms {

    public static function route($r) {
        $languages = \Languages::findByPublished(true);
        if (sizeof($languages) > 1) {
            $preLang = array();
            foreach ($languages as $lang) {
                $preLang[] = $lang->getLangCode();
            }

            $preLang = '{lang:(' .implode('|', $preLang) .')}';

            $nr = array();
            foreach ($r as $route => $value) {
                if ('/' == $route) {
                    $nr[$route] = $value;
                }
//                $nr[$route] = $value;
                if (strpos($route, '__') !== 0 && strpos($route, $preLang) !== 0) {
                    $nr[$preLang .'/' .ltrim($route, '/')] = $value;
                }
            }
            $r = $nr;
        }
        return $r;
    }
}