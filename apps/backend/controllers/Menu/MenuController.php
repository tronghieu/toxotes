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
        $message = Factory::getSession()->getFlash('menus.message');
        $error = Factory::getSession()->getFlash('menus.error');

        if (($group_id = $this->request()->get('group_id', 'INT', 0))) {
            $parent = \Menus::retrieveById($group_id);
        } else {
            $parent = \Menus::retrieveRoot();
        }

        $lists = $parent->getDescendants();

        $this->view()->assign(array(
            'lists' => $lists,
            'parent' => $parent
        ));

        return $this->renderComponent();
    }

    public function executeCreate() {
        $menu = new Menus();

        $error = array();
        if ($this->request()->isPostRequest()) {
            if ($this->_save($menu, $error)) {
                Factory::getSession()->setFlash('menus.message', t($menu->getName() .' was saved!'));
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
            Factory::getSession()->setFlash('menus.error', t('Menu not fond'));
        }

        $error = array();
        if ($this->request()->isPostRequest()) {
            if ($this->_save($menu, $error)) {
                Factory::getSession()->setFlash('menus.message', t($menu->getName() .' was saved!'));
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

    protected function _save(\Menus $menu, &$error) {
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

        if ($menu->type == \Menus::INTERNAL) {
            if (!$menu->route) {
                $error['menus.route'] = t("Menu's route is required.");
            }
        } else if ($menu->type == \Menus::EXTERNAL) {
            if (!$menu->link || !filter_var($menu->link, FILTER_VALIDATE_URL)) {
                $error['menus.link'] = t("Menu's link is invalid.");
            }
        }

        if (!empty($error)) {
            return false;
        }

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
                $error[$failure->getColumn()] = $failure->getMessage();
            }
        }

        return empty($error);
    }
}