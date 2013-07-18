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

    private function _initLanguages() {
        $this->languages = \Languages::findByPublished(true);
        if (sizeof($this->languages) < 2) {
            $this->currentLang = $this->languages[0];
            return;
        }

        $currentLangCode = $this->request()->get('lang');
        if (!$currentLangCode) {
            $currentLangCode = Factory::getCookie()->read('lang');
        }

        if (!$currentLangCode) {
            $this->currentLang = \Languages::findOneByDefault(true);
            $currentLangCode = $this->currentLang->getLangCode();
        }

        Factory::getCookie()->write('lang', $currentLangCode);

        if (Factory::getRouter()->getUrl() =='/' && !$this->request()->get('lang')) {
            $this->redirect($currentLangCode);
        }

        if (!$this->currentLang) {
            $this->currentLang = \Languages::findOneByLangCode($currentLangCode);
        }
    }

    public function makeLangUrl($langCode) {
        return $this->document()->getBaseUrl().$langCode;
    }

    public function raise404($mess = null) {}
}