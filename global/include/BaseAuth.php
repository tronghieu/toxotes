<?php
use Flywheel\Factory;

class BaseAuth extends Flywheel\Session\Authenticate {

    protected static $_instance;

    /**
     * get application authenticate object
     * @return BaseAuth
     */
    public static function getInstance() {
        if (null == self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function init() {
        if (null != ($id = Factory::getSession()->get('auth\id'))) {
            if ($user = Users::retrieveById($id)) {
//                $this->_setSession($user);
                $this->_setIsAuthenticated(true);
            }
        }
    }

    public function authenticate($email, $password) {
        if (empty($email)) {
            return self::ERROR_CREDENTIAL_INVALID;
        }

        if (empty($password)) {
            return self::ERROR_CREDENTIAL_INVALID;
        }

        $this->_identity = $email;
        $this->_credential = $password;

        $user = Users::findOneByEmail($email);
        if (empty($user)) {
            return self::ERROR_UNKNOWN_IDENTITY;
        }

        if($user->banned===1){
            return self::ERROR_UNKNOWN_IDENTITY;
        }

        if ($user->password != Users::hashPassword($password, $user->password)) {
            return self::ERROR_CREDENTIAL_INVALID;
        }

        $this->_setSession($user);
        $this->_setIsAuthenticated(true);

        return $this->isAuthenticated();
    }

    /**
     * get authenticated user
     * false if not authenticate or identity not found
     * @return bool|\Users
     */
    public function getUser() {
        if ($this->isAuthenticated()) {
            return Users::retrieveById(Factory::getSession()->get('auth\id'));
        }

        return false;
    }

    /**
     * logging out
     */
    public function logout() {
        $this->_clearSession();
        $this->_clearCookie();
    }

    private function _setSession(\Users $user) {
        Factory::getSession()->set('auth', array('id' => $user->id));
    }

    private function _clearSession() {
        Factory::getSession()->remove('auth');
    }

    private function _clearCookie() {
        Factory::getCookie()->writeSecure('auth', -100000);
    }
}