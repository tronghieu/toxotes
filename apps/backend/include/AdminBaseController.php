<?php
abstract class AdminBaseController extends \Flywheel\Controller\WebController {

    /**
     * get current login user
     * return Users
     */
    public function getCurrentUser() {
        return BackendAuthenticate::getInstance()->getUser();
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
    
    public function getBaseUrl()
    {
    	$document = \Flywheel\Factory::getDocument();
		return $document->getBaseUrl();
    }

    public function filter($action) {
    }
    
}
