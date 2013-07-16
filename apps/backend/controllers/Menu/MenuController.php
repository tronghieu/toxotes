<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 6/27/13
 * Time: 12:48 AM
 * To change this template use File | Settings | File Templates.
 */
use Flywheel\Factory;
use Flywheel\Loader;
use Toxotes\Plugin;

Loader::import('app.include.Tables.*');
class MenuController extends AdminBaseController {
    public function executeDefault() {
        $input = new stdClass();
        $error = array();
        $message = array();

        if ($this->request()->isPostRequest()) {
            $input = (object) $this->request()->post('new_menu', 'ARRAY', array());
            $newMenu = new Menus();
            $newMenu->hydrate($input);
            $newMenu->setTaxonomy('menu');
            $root = Menus::retrieveRoot('menu');
            $newMenu->insertAsLastChildOf($root);
            if (!$newMenu->isValid()) {
                foreach($newMenu->getValidationFailures() as $validationFailure) {
                    @$error['new_menu'][$validationFailure->getColumn()] = $validationFailure->getMessage();
                }
            } else {
                $input = new stdClass();
            }
        }

        $groups = Menus::getMenuGroup();
        $menusList = array();
        $group = false;
        $table = null;
        if (($groupId = $this->request()->get('group_id', 'INT', 0))) {
            if (!($group = Menus::retrieveById($groupId))) {
                $this->redirect($this->createUrl('menu/default'));
            }

            $menusList = $group->getDescendants();
            $table = new TermListTable('menu');
            $table->setItems($menusList);
        }

        if (!empty($error) && !isset($error['global'])) {
            $error['global'] = t('Something was wrong');
        }

        $this->view()->assign(array(
            'input' => $input,
            'list' => $menusList,
            'menu' => $groups,
            'select_menu' => $group,
            'table' => $table,
            'error' => $error,
            'message' => $message,
        ));

        return $this->renderComponent();
    }

    public function executeCreate() {
        $menu = new Menus();

        $error = array();
        if ($this->request()->isPostRequest()) {
            if ($this->_save($menu, $error)) {
                Factory::getSession()->setFlash('message', t($menu->getName() .' was saved!'));
                $this->redirect($this->createUrl('menu/default'));
            }
        }

        $this->setView('form');
        $this->view()->assign(array(
            'menu' => $menu,
            'error' => $error
        ));

        return $this->renderComponent();
    }

    public function executeEdit() {
        if (!($menu = \Menus::retrieveById($this->request()->get('id')))) {
            Factory::getSession()->setFlash('error', t('Menu not fond'));
        }

        $error = array();
        if ($this->request()->isPostRequest()) {
            if ($this->_save($menu, $error)) {
                Factory::getSession()->setFlash('message', t($menu->getName() .' was saved!'));
                $this->redirect($this->createUrl('menu/default'));
            }
        }

        $this->setView('form');
        $this->view()->assign(array(
            'menu' => $menu,
            'error' => $error
        ));

        return $this->renderComponent();
    }

    protected function _save(\Menus $menu, $error) {
        if ($menu->isNew() && ($parent_id = $this->request()->get('parent_id', 'INT', 0))) {
        } else {
            $parent_id = $this->request()->post('parent_id', 'INT', 0);
        }

        if ($parent_id) {
            $parent = Menus::retrieveById($parent_id);
        } else {
            $parent = Menus::retrieveRoot();
        }

        if (!$parent) {
            $error['parent'] = t('Not found menu parent with id:' .$parent_id);
            return false;
        }

        $isNew = $menu->isNew();

        $menu->hydrate($this->request()->post('menus', 'ARRAY', array()));

        if ($isNew) {
            $menu->insertAsLastChildOf($parent);
        } else {
            if ($parent->getId() == $menu->getId()) {
                $error['parent'] = t('Could not make child of itself');
                return false;
            }

            $currentParent = $menu->getParent();
            if ($currentParent->id != $parent->id) {//change parent
                $menu->moveToLastChildOf($parent);
            } else {//save normal
                if($menu->save()) {// only save information
                    return true;
                } else {
                    if (!$menu->isValid()) {
                        $failures = $menu->getValidationFailures();
                        foreach ($failures as $failure) {
                            if (!isset($error[$failure->getColumn()])) {
                                $error[$failure->getColumn()] = array();
                            }
                            $error[$failure->getColumn()][] = $failure->getMessage();
                        }

                        return empty($error);
                    }

                    return false;
                }
            } //end save normal
        }

        if (!$menu->isValid()) {
            $failures = $menu->getValidationFailures();
            foreach ($failures as $failure) {
                if (!isset($error[$failure->getColumn()])) {
                    $error[$failure->getColumn()] = array();
                }
                $error[$failure->getColumn()][] = $failure->getMessage();
            }
        }

        return empty($error);
    }
}