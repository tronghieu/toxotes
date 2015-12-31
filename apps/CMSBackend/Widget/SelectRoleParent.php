<?php
class SelectRoleParent extends \CMSBackend\Widget\CMSBackendBaseWidget {
    protected function _init() {
        if (!$this->label) {
            $this->label = t('Chose Parent');
        }
    }

    public function begin() {
        $root = \Roles::retrieveRoot();
        $this->roles = $root->getDescendants();
    }

    public function end() {
        $select = $this->form->selectOption($this->elementName, $this->selected, (array) $this->htmlOptions)
            ->addOption($this->label, '0');

        foreach ($this->roles as $role) {
            $selectName = ($role->getLevelValue() > 1)? str_repeat('&#8212;', $role->getLevelValue()-1) .$role->getName(): $role->getName();
            $select->addOption($selectName, $role->getId(), ['disabled' => (!$role->isActive())]);
        }

        ob_start();
        $select->display();
        $s = ob_get_clean();
        return $s;
    }
}