<?php
namespace CMSBackend\Library;


use Flywheel\Session\Session;
use Toxotes\BaseAuth;

class CMSBackendAuth extends BaseAuth {

    const ERROR_USER_NOT_ACCESS_ADMIN = -10;

    protected static $_instance = null;

    public function authenticate($credential, $password, $cookie = false) {
        $result = parent::authenticate($credential, $password, $cookie);

        if ($result > 0) {
            $user = $this->getUser();
            if (($user instanceof \Users) && $user->isActive() && $user->isStaff()) {
                $this->_setIsAuthenticatedAdmin(true);
                return true;
            }

            return self::ERROR_USER_NOT_ACCESS_ADMIN;
        }
        return $result;
    }

    protected function _setIsAuthenticatedAdmin($b) {
        $a = Session::get('auth');
        $a['admin'] = $b;
        Session::set('auth', $a);
    }

    public function isCMSBackendAuthenticated() {
        if (!$this->isAuthenticated()) {
            return false;
        }

        $auth = Session::get('auth\admin');
        return $auth;
    }

    public function buildPermission() {
        if ($user = $this->getUser()) {
            $data = Session::getInstance()->get('auth\permission');
            if (empty($data)) {
                $data = \Permissions::buildPermission($user);
            }

            Permission::getInstance()->init($data);
        }
    }
} 