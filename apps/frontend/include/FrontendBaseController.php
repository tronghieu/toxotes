<?php
use Flywheel\Factory;

/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 6/27/13
 * Time: 3:36 PM
 * To change this template use File | Settings | File Templates.
 */

abstract class FrontendBaseController extends \Toxotes\Controller{


    public function beforeExecute() {

        //init config
        $settingDat = (array) Setting::findAll();
        $setting = array();
        foreach ($settingDat as $s) {
            $setting[$s->getSettingKey()] = $s->getSettingValue();
        }

        $this->document()->title = $setting['site_name'];

        Factory::getView()->assign('setting', $setting);


       $this->_initLanguages();
    }

    public function makeLangUrl($langCode) {
        return $this->document()->getBaseUrl().$langCode;
    }

    public function raise404($mess = null) {}
}