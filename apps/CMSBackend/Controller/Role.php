<?php
namespace CMSBackend\Controller;

use CMSBackend\Event\CMSBackendEvent;
use Flywheel\Session\Session;

class Role extends CMSBackendBase {
    public function executeDefault()
    {
        if (!$this->isAllowed(PERMISSION_ROLE_VIEW)) {
            return $this->raise403(t("You don't have permission"));
        }

        $roles = \Roles::retrieveRoot()->getDescendants();
        $roles_arr = [];

        foreach($roles as $role) {
            $t = $role->toArray();
            $t['edit_link'] = $this->createUrl('role/form', ['id' => $role->getId()]);
            $t['permission_link'] = $this->createUrl('role/permissions', ['id' => $role->getId()]);
            $t['remove_link'] = $this->createUrl('role/remove', ['id' => $role->getId()]);
            $t['level'] = $role->getLevelValue();
            $roles_arr[] = $t;
        }

        $this->setView('Role/default');
        $this->view()->assign([
            'roles' => $roles_arr,
        ]);
        return $this->renderComponent();
    }

    public function executePermissions() {
        if (!$this->isAllowed(PERMISSION_ROLE_PERMISSION_MANAGE)) {
            return $this->raise403(t("You don't have permission"));
        }
        $id = $this->get('id');
        if (!$id || !($role = \Roles::retrieveById($id))) {
            return $this->raise404(t('Role not found!'));
        }

        //get role's members id
        /** @var \UserRole[] $userRoles */
        $userRoles = (array) \UserRole::findByRoleId($id);
        $staffs = \Users::findBySection(\Users::SECTION_STAFF);

        $members = [];
        $others = [];
        $t = [];

        foreach ($userRoles as $ur) {
            $t[$ur->getUserId()] = true;
        }

        foreach ($staffs as $staff) {
            if (isset($t[$staff->getId()])) {
                $members[$staff->getId()] = $staff;
            } else if ($staff->isActive()) {
                $others[$staff->getId()] = $staff;
            }
        }

        unset($members[1]);
        unset($others[1]);

        $assigned = \Permissions::findByRoleId($role->getId(), true);
        $permissions = \Permissions::getPermissionsList();

        foreach($permissions as $group => &$pg) {
            foreach($pg['permissions'] as $permission => &$detail) {
                if (isset($assigned[$permission])) {
                    $detail['assigned'] = true;
                } else {
                    $detail['assigned'] = false;
                }
            }
        }

        $this->setView('Role/detail');
        $this->view()->assign(array(
            'permissions' => $permissions,
            'role' => $role,
            'members' => $members,
            'otherGuys' => $others,
        ));

        return $this->renderComponent();
    }

    public function executeAddMember() {
        $this->validAjaxRequest();

        $ajax = new \AjaxResponse();

        if (!$this->isAllowed(PERMISSION_ROLE_PERMISSION_MANAGE)) {
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = t("You do not have permission fot this action");
            return $this->renderText($ajax->toString());
        }

        $user_id = $this->post('user_id', 'INT', 0);
        if (!$user_id || !($user = \Users::retrieveById($user_id))) {
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = t("User not found");
            return $this->renderText($ajax->toString());
        }

        $role_id = $this->post('role_id', 'INT', 0);
        if (!$role_id || !($role = \Roles::retrieveById($role_id))) {
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = t("Role not found");
            return $this->renderText($ajax->toString());
        }

        if (\Users::SECTION_STAFF != $user->getSection()) {
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = t("User %username% is not staff", array(
                "%username%" => $user->getUsername()
            ));
            return $this->renderText($ajax->toString());
        }

        if (!($userRole = \UserRole::findOneByRoleIdAndUserId($role->getId(), $user->getId()))) {
            $userRole = new \UserRole();
            $userRole->setRoleId($role->getId());
            $userRole->setUserId($user->getId());
            if($userRole->save()) {
                $role->setMemberNo($role->getMemberNo() +1);
                $role->save(false);
            }
        }

        $ajax->type = \AjaxResponse::SUCCESS;
        $ajax->message = t("Add member successful!");
        $ajax->user = $user->toArray();
        $ajax->role = $role->toArray();

        return $this->renderText($ajax->toString());
    }

    public function executeRemoveMember() {
        $this->validAjaxRequest();

        $ajax = new \AjaxResponse();

        if (!$this->isAllowed(PERMISSION_ROLE_PERMISSION_MANAGE)) {
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = t("You don't have permission");
            return $this->renderText($ajax->toString());
        }

        $user_id = $this->post('user_id', 'INT', 0);
        //not need check user

        $role_id = $this->post('role_id', 'INT', 0);
        if (!$role_id || !($role = \Roles::retrieveById($role_id))) {
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = self::t("Không có nhóm này");
            return $this->renderText($ajax->toString());
        }

        if (($userRole = \UserRole::findOneByRoleIdAndUserId($role->getId(), $user_id))) {
            if($userRole->delete()) {
                $role->setMemberNo($role->getMemberNo() - 1);
                $role->save(false);
            }
        }

        $ajax->type = \AjaxResponse::SUCCESS;
        $ajax->message = t("Remove member success!");
        $ajax->user_id = $user_id;
        $ajax->role = $role->toArray();

        return $this->renderText($ajax->toString());
    }

    public function executeSetPermission()
    {
        $this->validAjaxRequest();
        $ajax = new \AjaxResponse();

        if (!$this->isAllowed(PERMISSION_ROLE_PERMISSION_MANAGE)) {
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = t("You don't have permission");
            return $this->renderText($ajax->toString());
        }

        $role_id = $this->post('role_id', 'INT', 0);
        $permission = $this->post('permission');
        $allow = $this->post('allow');

        if ($allow == 'true') {
            $allow = true;
        } else {
            $allow = false;
        }

        if (!$role_id || !($role = \Roles::retrieveById($role_id))) {
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = t("Role not found");
            return $this->renderText($ajax->toString());
        }

        if (!$permission) {
            $ajax->type = \AjaxResponse::ERROR;
            $ajax->message = t("Empty permission code");
            return $this->renderText($ajax->toString());
        }

        if ($allow) {
            $role->addPermission($permission);
        } else {
            $role->removePermission($permission);
        }



        $ajax->type = \AjaxResponse::SUCCESS;
        $ajax->message = t("Change role permission success!");
        return $this->renderText($ajax->toString());
    }

    public function executeForm()
    {
        if (!$this->isAllowed(PERMISSION_ROLE_EDIT)) {
            return $this->raise403(t("You don't have permission"));
        }
        $id = $this->get('id');
        if ($id) {
            if (!($role = \Roles::retrieveById($id))) {
                return $this->raise404(t('Role not found!'));
            }
        } else {
            $role = new \Roles();
        }

        $is_new = $role->isNew();

        $session = Session::getInstance();
        $error = [];
        if ($this->request()->isPostRequest()) {
            if($this->_save($role, $error)) {
                $session->setFlash('role', [
                    'type' => 'SUCCESS',
                    'message' => t('Save successful!')
                ]);
                $this->redirect($this->createUrl('role/default'));
            }
        }

        $this->dispatch(($is_new)? 'onBeforeAddRole' : 'onBeforeEditRole', new CMSBackendEvent($this, [
            'role' => $role,
        ]));

        $this->setView('role/form');
        $this->view()->assign([
            'role' => $role,
            'error' => $error,
        ]);

        return $this->renderComponent();
    }

    /**
     * @param \Roles $role
     * @param $error
     * @return bool|\Roles
     * @throws \Exception
     */
    protected function _save(\Roles $role, &$error){
        $current_status = $role->getStatus();
        $data = $this->post('role', 'ARRAY', []);
        $role->hydrate($data);
        if (!isset($data['admin_access'])) {
            $role->setAdminAccess(0);
        }
        $parentId = $this->post('role_parent', 'INT', 0);

        if ($parentId == 0) {
            $parent = \Roles::retrieveRoot();
        } else {
            $parent = \Roles::retrieveById($parentId);
            if (!$parent) {
                $error['parent'] = array(
                    t('Role parent not found with id:' .$parentId)
                );
                return false;
            }
        }

        $is_new = $role->isNew();
        $role->beginTransaction();
        try {
            if ($is_new) {//always save
                $role->setParentId($parent->getId());
                $role->setStatus($parent->getStatus());
                $role->insertAsLastChildOf($parent);
                //dispatch event
                $this->dispatch('onCreateNewRole', new CMSBackendEvent($this, [
                    'role' => $role
                ]));
            } else {
                $currentParent = $role->getParent();
                if ($parent->getId() == $role->getId()) {//something fucked
                    $error['parent'] = t('Could not move to child of itself!');
                }

                if ($currentParent->getId() != $parent->getId()) {//move tree
                    $role->moveToLastChildOf($parent);
                    $role->setParentId($parent->getId());
                    $role->setStatus($parent->getStatus());

                    if (!$role->save()) {//save information first
                        $this->dispatch('onUpdateRole', new CMSBackendEvent($this, [
                            'role' => $role
                        ]));
                        if (!$role->isValid()) {
                            $failures = $role->getValidationFailures();
                            foreach($failures as $failure) {
                                $error[$failure->getColumn()] = $failure->getMessage();
                            }
                        }
                    }
                } else {//simply save information
                    if ($role->save()) {
                        //dispatch event update
                        $this->dispatch('onUpdateRole', new CMSBackendEvent($this, [
                            'role' => $role
                        ]));
                    } else if (!$role->isValid()) {
                        $failures = $role->getValidationFailures();
                        foreach($failures as $failure) {
                            $error[$failure->getColumn()] = $failure->getMessage();
                        }
                    }

                    if (!empty($error)) {
                        $role->rollBack();
                        return false;
                    }
                } //end simply save information

                if ($current_status != $role->getStatus()
                    && $role->getStatus() == \Roles::STATUS_INACTIVE) {//change status to INACTIVE
                    $role->changeDescendantsStatus(\Roles::STATUS_INACTIVE);
                }
            }
            if ($role->isValid()) {
                $role->commit();
                return $role;
            }
            $role->rollBack();
        } catch(\Exception $e) {
            $role->rollBack();
            throw $e;
        }

        $failures = $role->getValidationFailures();
        foreach($failures as $failure) {
            $error[$failure->getColumn()] = $failure->getMessage();
        }

        return false;
    }
}