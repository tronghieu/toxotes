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
        $this->document()->title .= t('Users Management');
        $keyword = $this->request()->get('keyword');
        $name = $this->request()->get('name');
        $status = $this->request()->get('status');
        $banned = $this->request()->get('banned');
        $page = $this->request()->get('page', 'INIT', 1);

        $query = Users::read()
            ->setMaxResults(25)
            ->setFirstResult($page-1);

        if ($keyword) {
            $query->andWhere("username LIKE '%{$keyword}%' OR email LIKE '%{$keyword}%'");
        }

        if ('' != $status) {
            $query->andWhere("status = {$status}");
        } else {
            $query->andWhere('`status` != ' .Users::STATUS_DELETED);
        }

        if ('' != $banned) {
            $query->andWhere("banned = {$banned}");
        }

        $users = $query->execute()->fetchAll(PDO::FETCH_CLASS, 'Users', array(null, false));

        $this->view()->assign(array(
            'users' => $users,
            'keyword' => $keyword,
            'name' => $name,
            'status' => $status,
            'banned' => $banned,
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

    public function executeDelete() {
        $this->validAjaxRequest();

        $ids = $this->request()->post('id', 'ARRAY', array());

        $_ids = array();
        foreach($ids as $id) {
            $u = Users::retrieveById($id);
            $u->status = Users::STATUS_DELETED;
            if ($u->save()) {
                $_ids[] = $u->getId();
            }
        }

        $res = new AjaxResponse();

        if (sizeof($_ids) > 0 ) {
            $res->type = AjaxResponse::SUCCESS;
            $res->ids = $_ids;
        } else {
            $res->type = AjaxResponse::WARNING;
            $res->message = t('Something was wrong!');
        }

        return $this->renderText($res->toString());
    }
}