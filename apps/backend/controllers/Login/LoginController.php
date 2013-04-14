<?php
use Flywheel\Config\ConfigHandler;
use Flywheel\Factory;
use Flywheel\Validator\Util as ValidatorUtil;
class LoginController extends AdminBaseController
{
    public function beforeExecute() {
        parent::beforeExecute();

        $this->setLayout('login');
    }

	public function executeDefault()
	{
		return $this->executeLogin();
	}

    public function executeLogin() {

        if (BackendAuthenticate::getInstance()->isAuthenticated()) {
            $r = ($this->request()->get('r'))? urldecode($this->request()->get('r')) : '/';
            $this->redirect($r);
        }

        $this->view()->assign('action', Factory::getRouter()->getUri());
        if($this->request()->isPostRequest()){
            $email = $this->request()->post('email');
            $pass = $this->request()->post('password');

            $auth = BackendAuthenticate::getInstance();

            if (($result = $auth->authenticate($email, $pass))) {
                $this->redirect($r);
            }
        }
        return $this->renderComponent();
    }

    public function executeLogout() {
        BackendAuthenticate::getInstance()->logout();
        $this->redirect($this->createUrl('login/login'));
    }
}