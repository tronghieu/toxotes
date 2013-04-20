<?php
use Backend\Event\Event;

class AuthController extends AdminBaseController {
    public function executeDefault() {
        return $this->executeLogin();
    }

    public function executeLogin() {
        //return if signed
        if (BackendAuth::getInstance()->isAuthenticated()) {
            $back = $this->request()->get('r');
            $back = (null != $back)? urldecode($back) : '/';
            $this->redirect($back);
        }

        $this->setLayout('login');
        $this->setView('login');

        $credential = '';
        $error = array();

        if ($this->request()->isPostRequest()) {
            $credential = $this->request()->post('credential');
            $password = $this->request()->post('password');

            $auth = BackendAuth::getInstance();
            if (true == ($result = $auth->authenticate($credential, $password))) {
                //authenticated, redirect to pre-page
                $back = $this->request()->get('r');
                $back = (null != $back)? urldecode($back) : '/';

                //dispatch event
                $this->dispatch('onAfterSigningIn', new Event($this));
                $this->redirect($back);
            } else {
                //check and display error
                if ($result == BackendAuth::ERROR_UNKNOWN_IDENTITY
                    || $result == BackendAuth::ERROR_CREDENTIAL_INVALID
                    || $result == BackendAuth::ERROR_IDENTITY_INVALID) {
                    $error[] = "Credential or password invalid!";
                }

                if ($result == BackendAuth::ERROR_USER_WAS_BANNED) {
                    $error[] = "This user was banned by administrator!";
                }

                if ($result == BackendAuth::ERROR_USER_NOT_ACCESS_ADMIN) {
                    $error[] = "This user hasn't access AdminCP permission!";
                }
            }
        }
        $this->view()->assign(array(
            'credential' => $credential,
            'error' => $error
        ));
        return $this->renderComponent();
    }

    public function executeLogout() {
        BackendAuth::getInstance()->logout();

        //dispatch event
        $this->dispatch('onAfterSigningOut' , new Event($this));
        $this->redirect($this->createUrl('auth/login'));
    }

    public function executeAccessDenied() {}
}