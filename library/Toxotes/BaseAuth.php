<?php
namespace Toxotes;


use Flywheel\Base;
use Flywheel\Db\Type\DateTime;
use Flywheel\Factory;
use Flywheel\Session\Authenticate;
use Flywheel\Session\Session;

class BaseAuth extends Authenticate {
    protected static $_instance = null;

    /**
     * @return BaseAuth
     */
    public static function getInstance() {
        if(null === static::$_instance){
            static::$_instance = new static();
        }

        return static::$_instance;
    }


    public function init() {
        if (null != ($id = Session::get('auth\id'))) { //session write
            $this->_setIsAuthenticated(true);
        } else { //check in Cookie
            $cookie = Factory::getCookie();
            if ($data = $cookie->readSecure('auth')) {
                $data = json_decode($data, true);

                $user = \Users::retrieveByUsername($data['username']);
                if ($user && $data['secret_key'] == $user->getSecret()) {
                    //@TODO should throw a event, push to queue and tracking last login time in background
                    $user->setLastVisitTime(new DateTime());
                    $user->save();

                    $this->setSession($user);
                    $this->setCookie($user);
                    $this->_setIsAuthenticated(true);
                }
            }
        }
    }


    public function authenticate($credential, $password, $cookie = false) {
        $this->dispatch('onBeginAuthenticate', new BaseEvent($this,array($credential)));

        if (empty($credential) || empty($password)) return self::ERROR_CREDENTIAL_INVALID;

        $this->_identity = $credential;
        $this->_credential = $password;

        if (strpos($credential, '@') !== false) {
            $user = \Users::retrieveByEmail($credential);
        } else {
            $user = \Users::retrieveByUsername($credential);
        }

        if(!$user || empty($user) || !($user instanceof \Users)){
            return self::ERROR_UNKNOWN_IDENTITY;
        }

        if(($user instanceof \Users)) {
            if ($user->password != \Users::hashPassword($password, $user->password))
            {
                return self::ERROR_CREDENTIAL_INVALID;
            }

            $this->_clearCookie();
            if ($cookie) {
                $this->setCookie($user);
            }

            $this->setSession($user);
            $this->_setIsAuthenticated(true);
            $user->setLastVisitTime(new DateTime());
            $user->setLastLoginIp(Base::getApp()->getClientIp());
            $user->save();

            if ($user)
            {
                $this->dispatch('onAfterAuthenticate', new BaseEvent($this,$user->getAttributes()));
            }

            return $this->isAuthenticated();
        }
        return false;
    }

    /**
     * @return \Users
     */
    public function getUser() {
        $id = $this->getUserId();
        return \Users::retrieveById($id);
    }

    public function getUserId() {
        return Session::get('auth\id');
    }

    /**
     * log out
     */
    public function logout() {
        Session::set('auth',null);
        Session::getInstance()->remove('auth');
        $this->_clearCookie();
        $this->_setIsAuthenticated(false);
    }

    /**
     * set session
     */
    public function setSession(\Users $user) {
        Session::set('auth',  array('id'=>$user->getId()));
    }

    public function setCookie(\Users $user) {
        $cookie = Factory::getCookie();
        $cookie->writeSecure('auth', json_encode($user->getAttributes('username,secret_key')));
    }

    private function _clearCookie() {
        Factory::getCookie()->writeSecure('auth', null, -100000);
    }
} 