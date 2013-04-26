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
    public function executeDefault() {
        $username = $this->request()->get('username');
        $name = $this->request()->get('name');
        $status = $this->request()->get('status');
        $banned = $this->request()->get('banned');
        $page = $this->request()->get('page', 'INIT', 1);
        $email = $this->request()->get('email');

        $query = Users::read()->setMaxResults(25)->setFirstResult($page-1);
        if ($username) {
            $query->andWhere("username LIKE '%{$username}%'");
        }

        if ($email) {
            $query->andWhere("email LIKE '%{$email}%'");
        }

        if (null !== $status) {
            $query->andWhere("status = {$status}");
        }

        if (null !== $banned) {
            $query->andWhere("banned = {$banned}");
        }

        $users = $query->execute()->fetchObject('Users', array(null, false));

        $this->view()->assign(array(
            'users' => $users,
            'name' => $name,
            'status' => $status,
            'banned' => $banned,
            'email' => $email,
            'page' => $page,
        ));

        return $this->renderComponent();
    }

    public function executeCreate() {
        $this->setView('form');
        $user = new Users();

        $error= array();

        $message = '';

        $new_pass = '';

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

            $user->hydrate($this->request()->post('user', 'ARRAY'));

            if ($this->_save($user, $error)) {
                $session = Factory::getSession();
                $session->setFlash('message', t('Save successful!'));
                $this->redirect($this->createUrl('user/edit', array('id' => $user->getId())));
            }
        }

        $this->view()->assign('user', $user);
        $this->view()->assign('error', $error);
        $this->view()->assign('message', $message);
        $this->view()->assign('page_title', t('Add new user'));
        $this->document()->title .= t('Add new user');

        $this->view()->assign('new_password', $new_pass);
        return $this->renderComponent();
    }

    public function executeEdit() {
        $this->setView('form');
        $user = Users::retrieveById($this->request()->get('id'));

        $session = Factory::getSession();

        if (!$user) {
            $session->setFlash('warning', 'user not found');
            $this->redirect($this->createUrl('user'));
        }

        $new_pass = '';

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

            $user->hydrate($this->request()->post('user', 'ARRAY'));
            if ($this->_save($user, $error)) {
                $message = t("Save successful!");
            }
        }

        $this->view()->assign('user', $user);
        $this->view()->assign('error', $error);
        $this->view()->assign('message', $message);
        $this->view()->assign('page_title', t('Edit user ' .$user->username));
        $this->document()->title .= t('Edit user ' .$user->username);

        $this->view()->assign('new_password', $new_pass);
        return $this->renderComponent();
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
                    if (!isset($error[$validationFailure->getColumn()])) {
                        $error[$validationFailure->getColumn()] = '';
                    }
                    $error[$validationFailure->getColumn()] .= $validationFailure->getMessage();
                }
            }
        }

        return false;
    }
}