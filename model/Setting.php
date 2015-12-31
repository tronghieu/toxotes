<?php 
/**
 * Setting
 * @version		$Id$
 * @package		Model

 */

require_once dirname(__FILE__) .'/Base/SettingBase.php';
class Setting extends \SettingBase {
    protected static $_settings;

    /**
     * Get all system setting
     *
     * @return mixed
     */
    public static function getAllSettings() {
        if (null == self::$_settings) {
            /** @var \Setting[] $stt */
            $stt = self::findAll();
            foreach($stt as $s) {
                self::$_settings[$s->getSettingKey()] = $s->getSettingValue();
            }
        }

        return self::$_settings;
    }

    /**
     * Get system setting by key
     *
     * @param $key
     * @return null
     */
    public static function get($key) {
        $s = self::getAllSettings();
        return (isset($s[$key]))? $s[$key] : null;
    }
}