<?php

namespace CMSBackend\Controller;

use CMSBackend\Library\CMSBackendAuth;
use Flywheel\Captcha\Math;
use Flywheel\Factory;

class Login extends CMSBackendBase
{
    protected $_need_login = false;
    public function executeDefault()
    {
        return $this->executeLogin();
    }

    public function executeLogin()
    {
        $this->document()->title = t('Login');
        $this->setLayout('login');
        $this->setView('Login/default');

        /** @var CMSBackendAuth $backendAuth */
        $backendAuth = CMSBackendAuth::getInstance();

        $comeback = $this->get('r');
        $comeback = (null != $comeback) ? urldecode($comeback) : '/';
        if ($backendAuth->isCMSBackendAuthenticated()) {
            $this->redirect($comeback);
        }

        $display = $this->post('credential');
        if (!$display) {
            $display = Factory::getCookie()->read('username');
        }

        $languages = \Languages::getAllActiveLanguages('lang_code');

        $error = array();

        if ($this->request()->isPostRequest()) {
            //check captcha first
            $password = $this->post('password');
            $credential = $this->post('credential'); //don't care display name
            $chosen_lang = $this->post('language');
            Factory::getCookie()->write('language', $chosen_lang);
            /*$captcha = $this->post('captcha');*/
            Factory::getCookie()->write('username', $credential);

            /*if(Math::check($captcha)==false) {
                $error[] = t('Sai rồi, tính nhẩm kém quá');
            }*/

            if (empty($error) && true === ($result = $backendAuth->authenticate($credential, $password))) {
                //authenticated, redirect to pre-page
                $this->redirect($comeback);
            } else if (isset($result)) {
                switch ($result) {
                    case CMSBackendAuth::ERROR_USER_NOT_ACCESS_ADMIN:
                        $error[] = t('Restricted area, no permission');
                        break;
                    case CMSBackendAuth::ERROR_CREDENTIAL_INVALID:
                        $error[] = t('Plz re-enter your email or your password');
                        break;
                    case CMSBackendAuth::ERROR_UNKNOWN_IDENTITY:
                        $error[] = t('Unknown identity');
                        break;
                    default:
                        $error[] = t('Login fail');
                }
            }
        }

        $this->view()->assign('display', $display);
        $this->view()->assign('error', $error);
        $this->view()->assign('current_lang', ($this->currentLang)? $this->currentLang->getLangCode() : '');
        $this->view()->assign('languages', $languages);

        return $this->renderComponent();
    }

    public function executeLogout()
    {
        CMSBackendAuth::getInstance()->logout();
        $this->redirect($this->createUrl('/'));
    }
}