<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/7/14
 * Time: 8:45 AM
 */

namespace CMSBackend\Controller;


use CMSBackend\Event\CMSBackendEvent;
use CMSBackend\Library\CMSBackendAuth;
use Flywheel\Db\Type\DateTime;
use Flywheel\Factory;
use Flywheel\Session\Session;
use Flywheel\Validator\Util;
use Toxotes\Logger;

class User extends CMSBackendBase {
    public $maxRecordPerPage = 30;
    public function executeDefault()
    {
        $this->setView('User/default');

        $doc = $this->document();
        $doc->addJsVar('user_list_url', $this->createUrl('user/default'));
        $doc->addJsVar('user_search_url', $this->createUrl('user/search'));

        $this->view()->assign(array(
            'keyword' => $this->get('keyword'),
            'section' => $this->get('section'),
            'status' => $this->get('status'),
            'page' => $this->get('page', 'INT', 1),
            'ordering' => $this->get('ordering'),
        ));

        return $this->renderComponent();
    }

    public function executeSearch() {
//        $this->validAjaxRequest();
        $ajax = new \AjaxResponse();

        $query = \Users::select();

        $keyword = $this->get('keyword');
        $section = $this->get('section');
        $status = $this->get('status');
        $banned = $this->get('banned', 'INT', -1);
        $ordering = $this->get('ordering', 'STRING', 'username');
        //paging
        $page = $this->get('page', 'INT', 1);

        //search by keyword
        if ($keyword) {
            if (is_numeric($keyword)) {
                $query->andWhere('`id` = :keyword');
                $query->setParameter(':keyword', $keyword, \PDO::PARAM_INT);
            } else if (Util::isValidEmail($keyword)) {
                $query->andWhere('`email` = :keyword');
                $query->setParameter(':keyword', $keyword, \PDO::PARAM_STR);
            } else {
                $keyword = explode(' ', $keyword);
                foreach($keyword as $k) {
                    $k = trim($k);
                    if ($k) {
                        $query->orWhere('`username` LIKE "%' .$k .'%"')
                            ->orWhere('`name` LIKE "%' .$k .'%"');
                    }
                }
            }
        }

        //search by section
        if ($section) {
            $query->andWhere("`section` = :section")
                ->setParameter(':section', $section, \PDO::PARAM_STR);
        }

        //search by status
        if ($status) {
            $query->andWhere('`status` = :status')
                ->setParameter(':status', $status, \PDO::PARAM_STR);
        }

        //search by is banned
        if (-1 != $banned) {
            $query->andWhere('`banned` = :banned')
                ->setParameter(':banned', $banned, \PDO::PARAM_INT);
        }

        switch ($ordering) {
            case 'last_visit_time':
                $query->orderBy('last_visit_time', 'DESC');
                break;
            case 'register_time':
                $query->orderBy('register_time', 'DESC');
                break;
            default:
                $query->orderBy('username', 'ASC');
        }


        //count for paging
        $countQuery = clone $query;
        $total = $countQuery->count('id')->execute();

        $query->setMaxResults($this->maxRecordPerPage)
            ->setFirstResult(($page-1) * $this->maxRecordPerPage);

        /** @var \Users[] $users */
        $users = $query->execute();
        $result = array();

        if (!empty($users))
        {
            foreach($users as $user)
            {
                $t = $user->toArray();
                unset($t['password']);
                unset($t['secret']);
                if (!$user->getBirthday()->isEmpty()) {
                    $t['birthday'] = $user->getBirthday()->format('d/m/Y');
                } else {
                    $t['birthday'] = null;
                }

                $t['deleted'] = $user->isDeleted();

                $t['avatar'] = \Toxotes\Util::gravatar($user->getEmail(), '32');
                $t['edit_link'] = $this->createUrl('user/edit', ['id' => $user->getId()]);

                $result[] = $t;
            }
        }
        $ajax->type = \AjaxResponse::SUCCESS;
        $ajax->users = $result;
        $ajax->total = $total;
        $ajax->page_size = $this->maxRecordPerPage;
        $ajax->page = $page;
        return $this->renderText($ajax->toString());
    }

    public function executeCreate() {
        $this->setView('User/form');
        $user = new \Users();

        $error= array();

        $message = '';

        $new_pass = '';

        if ($this->request()->isPostRequest()) {
            if ('' != ($new_pass = $this->request()->post('new_password'))) {
                //set new password
                if ($new_pass != $this->request()->post('confirm_password')) {
                    $error['users.new_password'] = t('password not match!');
                } else {
                    $user->setPassword(\Users::hashPassword($new_pass));
                }
            } else {
                $error['users.new_password'] = t('password can not be empty!');
            }

            $user->hydrate($this->request()->post('user', 'ARRAY'));

            if ($this->_save($user, $error)) {
                $session = Session::getInstance();
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
        $this->setView('User/form');
        $user = \Users::retrieveById($this->request()->get('id'));

        $session = Session::getInstance();

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
                    $user->setPassword(\Users::hashPassword($new_pass));
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

    protected function _save(\Users $user, &$error) {
        $isNew = $user->isNew();
        if ($isNew) {
            //check username was taken
            if(!\Users::checkAvailableUsername($user->getUsername())) {
                $error['users.username'] = t('Username was taken');
            }

            if (!\Users::checkAvailableEmail($user->getEmail())) {
                $error['users.email'] = t('Email was taken');
            }

        }


        if (empty($error)) {
            if ($user->save()) {
                //dispatching event
                if ($isNew) {
                    $this->dispatch('afterCreatingUser', new CMSBackendEvent($this, ['user' => $user]));
                } else {
                    $this->dispatch('afterSavingUser', new CMSBackendEvent($this, ['user' => $user]));
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
            $u = \Users::retrieveById($id);
            $u->status = \Users::STATUS_DELETED;
            if ($u->save()) {
                $_ids[] = $u->getId();
            }
        }

        $res = new \AjaxResponse();

        if (sizeof($_ids) > 0 ) {
            $res->type = \AjaxResponse::SUCCESS;
            $res->ids = $_ids;
        } else {
            $res->type = \AjaxResponse::WARNING;
            $res->message = t('Something was wrong!');
        }

        return $this->renderText($res->toString());
    }

    public function executeProfiles() {
        $user = $this->getSessionUser();
        $this->setView('User/profiles');

        $error = [];
        $message = null;

        //JS Urls
        $this->document()->addJsVar('change_pass_url', $this->createUrl('user/change_pass'));

        if ($this->request()->isPostRequest()) {

            $data = $this->post('user', 'ARRAY', []);
            //for save
            unset($data['username']);
            unset($data['password']);
            unset($data['secret']);
            unset($data['register_time']);
            unset($data['modified_time']);

            $data['birthday'] = DateTime::createFromFormat('d/m/Y', $data['birthday']);

            $user->hydrate($data);
            if ($user->isColumnModified('email')
                && !\Users::checkAvailableEmail($user->getEmail())) {
                //he change his's email, need check it exists
                $error['email'] = t('Email was taken!');
            }

            if (empty($error)) {
                if ($user->save()) {
                    $message = t('Update your profiles success!');
                } else if (!$user->isValid()) {
                    foreach($user->getValidationFailures() as $failure) {
                        $error[$failure->getColumn()] = $failure->getMessage();
                    }
                } else {
                    //unknow error
                    $error['common'] = t('Error occur, plz try again. Thanks');
                }
            }
        }

        $this->view()->assign([
            'user' => $user,
            'error' => $error,
            'message' => $message,
        ]);

        return $this->renderComponent();
    }

    /**
     * Change password, XHR request
     *
     * POST /user/change_pass
     * @return string
     */
    public function executeChangePass() {
        $current = $this->post('current_pass');
        $new = $this->post('new_pass');
        $confirm = $this->post('confirm_pass');

        $user = $this->getSessionUser();

        $error = [];

        if ($new != $confirm) {
            $error['confirm'] = t('Confirm password not match!');
        }

        if ($user->getPassword() != \Users::hashPassword($current, $user->getPassword())) {
            $error['current_pass'] = t('Current password not valid!');
        }

        $ajax = new \AjaxResponse();
        $ajax->type = \AjaxResponse::ERROR;

        if (!empty($error)) {
            $ajax->message = t('Lỗi');
            $ajax->error = $error;
            return $this->renderText($ajax->toString());
        }

        //everything ok
        $user->setPassword(\Users::hashPassword($new, $user->getPassword())); //reset password but keep salt
        if ($user->save(false)) {//quick save
            $ajax->type = \AjaxResponse::SUCCESS;
            $ajax->message = t('Password was change. Plz login again with new password!');
            CMSBackendAuth::getInstance()->logout();
        } else {
            $ajax->message = t('Something went wrong, plz try again. Thanks!');
        }

        return $this->renderText($ajax->toString());
    }
}