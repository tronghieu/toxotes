<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 6/27/13
 * Time: 12:48 AM
 * To change this template use File | Settings | File Templates.
 */

class MenuController extends AdminBaseController {
    public function executeDefault() {
        $input = new stdClass();
        $error = array();
        $message = array();

        if ($this->request()->isPostRequest()) {
            $input = (object) $this->request()->post('new_menu', 'ARRAY', array());
            $newMenu = new Menu();
            $newMenu->hydrate($input);
            $newMenu->setTaxonomy('menu');
            $root = Menu::retrieveRoot('menu');
            $newMenu->insertAsLastChildOf($root);
            if (!$newMenu->isValid()) {
                foreach($newMenu->getValidationFailures() as $validationFailure) {
                    @$error['new_menu'][$validationFailure->getColumn()] = $validationFailure->getMessage();
                }
            } else {
                $input = new stdClass();
            }
        }

        $groups = Menu::getMenuGroup();
        $menusList = array();
        $group = false;
        if (($groupId = $this->request()->get('group_id', 'INT', 0))) {
            if (!($group = Menu::retrieveById($groupId))) {
                $this->redirect($this->createUrl('menu/default'));
            }

            $menusList = $group->getDescendants();
        }

        if (!empty($error) && !isset($error['global'])) {
            $error['global'] = t('Something was wrong');
        }

        $this->view()->assign(array(
            'input' => $input,
            'list' => $menusList,
            'menu' => $groups,
            'select_menu' => $group,
            'error' => $error,
            'message' => $message
        ));

        return $this->renderComponent();
    }
}