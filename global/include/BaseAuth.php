<?php
use Flywheel\Factory;

class BaseAuth extends Flywheel\Session\Authenticate {
    const ERROR_USER_WAS_BANNED = -10;

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
                $this->_setSession($user);
                $this->_setIsAuthenticated(true);
            }
        }

        //check in Cookie
        $cookie = Factory::getCookie();
        if ($data = $cookie->readSecure('auth')) {
            $data = json_decode($data, true);
            if (($user = Users::findOneByUsernameAndSecret($data['username'], $data['secret']))
            && !$user->getBanned()) {
                $this->_setSession($user);
                $this->_setCookie($user);
                $this->_setIsAuthenticated(true);
            }
        }
    }

    public function authenticate($credential, $password, $cookie = false) {
        if (empty($credential)) {
            return self::ERROR_CREDENTIAL_INVALID;
        }

        if (empty($password)) {
            return self::ERROR_CREDENTIAL_INVALID;
        }

        $this->_identity = $credential;
        $this->_credential = $password;

        $user = Users::findOneByUsername($credential);
        if (empty($user)) {
            $user = Users::findOneByEmail($credential);
        }

        if (empty($user)) {
            return self::ERROR_UNKNOWN_IDENTITY;
        }

        if($user->getBanned()){
            return self::ERROR_USER_WAS_BANNED;
        }

        if ($user->password != Users::hashPassword($password, $user->password)) {
            return self::ERROR_CREDENTIAL_INVALID;
        }

        $this->_setSession($user);
        $this->_setIsAuthenticated(true);

        if ($cookie) {
            $this->_setCookie($user);
        }

        $user->setLastVisitTime(new \Flywheel\Db\Type\DateTime());
        $user->save();
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
        Factory::getSession()->set('auth', array('id' => $user->getId()));
    }

    private function _setCookie(\Users $user) {
        $cookie = Factory::getCookie();
        $cookie->writeSecure('auth', json_encode($user->getAttributes('username,secret')));
    }

    private function _clearSession() {
        Factory::getSession()->remove('auth');
    }

    private function _clearCookie() {
        Factory::getCookie()->writeSecure('auth', null, -100000);
    }
}