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

    /**
     * get current login user
     * return Users
     */
    public function getSessionUser() {
        return BackendAuth::getInstance()->getUser();
    }
    
    public function createUrl($route, $params=array(), $ampersand='&') {
		$p= array();
		foreach($params as $key=>$param) {
			$p[]= $key.'='.$param;
		}

		if(strpos($route,'?') !== false) {
            return $route.'&'.implode($ampersand, $p);
        } else {
            return $route.'?'.implode($ampersand, $p);
        }
    }
}
