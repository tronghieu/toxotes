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

    /**
     * @var \Languages
     */
    public static $currentLang;

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
                $nr[$route] = $value;
                if (strpos($route, '__') !== 0 && strpos($route, $preLang) !== 0) {
                    $nr[$preLang .'/' .ltrim($route, '/')] = $value;
                }
            }
            $r = $nr;
        }
        return $r;
    }

    /**
     * @param $id
     * @param array $parameters
     * @param string $domain
     * @param null $locale
     *
     * @return mixed|string
     */
    public static function t($id, array $parameters = array(), $domain = 'messages', $locale = null) {
        if (null == $locale && self::$currentLang) {
            $locale = self::$currentLang->getLangCode();
        }

        return t($id, $parameters, $domain, $locale);
    }

    /**
     * display translation message
     *
     * @param $id
     * @param array $parameters
     * @param string $domain
     * @param null $locale
     */
    public static function td($id, array $parameters = array(), $domain = 'messages', $locale = null) {
        echo self::t($id, $parameters, $domain, $locale);
    }
}