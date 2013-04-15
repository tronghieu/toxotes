<?php
class AuthController extends AdminBaseController {
    public function beforeExecute() {
        parent::beforeExecute();
        if (BackendAuth::getInstance()->isAuthenticated()) {
            $back = $this->request()->get('r');
            $back = (null != $back)? urldecode($back) : '/';
            $this->redirect($back);
        }
    }

    public function executeDefault() {
        return $this->executeLogin();
    }

    public function executeLogin() {
        if ($this->request()->isPostRequest()) {
            $credential = $this->request()->post('credential');
            $password = $this->request()->post('password');

            $auth = BackendAuth::getInstance();
            if ($result = $auth->authenticate($credential, $password)) {
                //authenticated, redirect to pre-page
                $back = $this->request()->get('r');
                $back = (null != $back)? urldecode($back) : '/';
                $this->redirect($back);
            } else {
                //check and display error
            }
        }

        return $this->renderComponent();
    }

    public function executeLogout() {
        BackendAuth::getInstance()->logout();
        $this->redirect('/');
    }

    public function executeAccessDenied() {}
}