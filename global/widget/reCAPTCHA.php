<?php
use Flywheel\Config\ConfigHandler;
use Flywheel\Factory;

require_once LIBRARY_PATH .'/recaptchalib.php';

class reCAPTCHA extends \Flywheel\Controller\Widget {
    public function begin() {
        Factory::getDocument()->addJs('http://www.google.com/recaptcha/api/js/recaptcha_ajax.js', 'TOP');
        Factory::getDocument()->addJsCode('
        Recaptcha.create("' .ConfigHandler::get('recaptcha_public_key') .'",
            "recaptcha",
            {
              callback: Recaptcha.focus_response_field
            }
          );');
    }
    public function end() {
        return '<div id="recaptcha"></div>';
    }
}