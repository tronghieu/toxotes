<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 4/22/13
 * Time: 5:34 PM
 * To change this template use File | Settings | File Templates.
 */

use Flywheel\Factory;

class UserController extends AdminBaseController {
    public function executeDefault() {}

    public function executeCreate() {
        $this->setView('form');
        $user = new Users();

        $error= array();

        $message = '';

        if ($this->request()->isPostRequest()) {
            if ('' != ($new_pass = $this->request()->post('new_password'))) {
                //set new password
                if ($new_pass != $this->request()->post('confirm_password')) {
                    $error['users.new_password'] = t('password not match!');
                } else {
                    $user->setPassword(Users::hashPassword($new_pass));
                }
            } else {
                $error['users.new_password'] = t('password can not be empty!');
            }

            $user->hydrate($this->request()->post('user'));

            if ($this->_save($user, $error)) {
                $session = Factory::getSession();
                $session->setFlash('message', t('Save successful!'));
                $this->redirect($this->createUrl('user/edit', array('id' => $user->id)));
            }
        }

        $this->view()->assign('user', $user);
        $this->view()->assign('error', $error);
        $this->view()->assign('message', $message);
        $this->view()->assign('page_title', t('Create new user'));
    }

    public function executeEdit() {
        $this->setView('form');
        $user = Users::retrieveById($this->request()->get('id'));

        $session = Factory::getSession();

        if (!$user) {
            $session->setFlash('warning', 'user not found');
            $this->redirect($this->createUrl('user'));
        }

        $error = array();
        $message = $session->getFlash('message');

        if ($this->request()->isPostRequest()) {
            if (($new_pass = $this->request()->post('new_password'))) {
                //set new password
                if ($new_pass != $this->request()->post('confirm_password')) {
                    $error['users.new_password'] = t('Password not match!');
                } else {
                    $user->setPassword(Users::hashPassword($new_pass));
                }
            }

            $user->hydrate($this->request()->post('user'));
            if ($this->_save($user, $error)) {
                $message = t("Save successful!");
            }
        }

        $this->view()->assign('user', $user);
        $this->view()->assign('error', $error);
        $this->view()->assign('message', $message);
        $this->view()->assign('page_title', t('Edit user' .$user->username));
    }

    protected function _save(Users $user, &$error) {
        $isNew = $user->isNew();
        if (empty($error)) {
            if ($user->save()) {
                //dispatching event
                if ($isNew) {
                    $this->dispatch('afterCreatingUser', new AdminEvent($this, array('user' => $user)));
                } else {
                    $this->dispatch('afterSavingUser', new AdminEvent($this, array('user' => $user)));
                }

                return true;
            } else if (!$user->isValid()) {
                /** @var \Flywheel\Model\ValidationFailed[] $validationFailures  */
                $validationFailures = $user->getValidationFailures();
                foreach($validationFailures as $validationFailure) {
                    $error[$validationFailure->getColumn()] .= $validationFailure->getMessage();
                }
            }
        }

        return false;
    }
}