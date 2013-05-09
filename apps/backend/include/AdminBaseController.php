<?php
abstract class AdminBaseController extends \Flywheel\Controller\WebController {
    public function beforeExecute() {
        parent::beforeExecute();
        if($this->getName() != 'Auth' && !BackendAuth::getInstance()->isAuthenticated()) {
            $this->redirect(
                $this->createUrl('auth/login', array(
                    'r' => urlencode(\Flywheel\Factory::getRouter()->getUrl()))));
        }
    }

    protected function _beforeRender() {
        $this->view()->assign('controller', $this);
        parent::_beforeRender();
    }

    /**
     * get current login user
     * return Users
     */
    public function getSessionUser() {
        return BackendAuth::getInstance()->getUser();
    }
}
