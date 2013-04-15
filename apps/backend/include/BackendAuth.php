<?php
use Flywheel\Factory;

class BackendAuth extends BaseAuth {
    const ERROR_USER_NOT_ACCESS_ADMIN = -10;

    public function authenticate($credential, $password) {
        $result = parent::authenticate($credential, $password, false);
        if ($result) {
            $user = $this->getUser();
            //check admin access here
        }

        return $result;
    }
}