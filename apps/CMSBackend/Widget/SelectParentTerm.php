<?php
use CMSBackend\Widget\CMSBackendBaseWidget;
use Toxotes\Plugin;

class SelectParentTerm extends CMSBackendBaseWidget {
    protected function _init() {
        if (!$this->label) {
            $this->label = t('Parent');
        }
    }

    public function begin() {
        $root = Terms::retrieveRoot($this->taxonomy);
        $this->terms = $root->getDescendants();
    }

    public function end() {
        $select = $this->form->selectOption($this->elementName, $this->selected, (array) $this->htmlOptions)
            ->addOption($this->label, '0');

        foreach ($this->terms as $term) {
            $selectName = ($term->getLevelValue() > 1)? str_repeat('&#8212;', $term->getLevelValue()-1) .$term->getName(): $term->getName();
            $select->addOption($selectName, $term->getId());
        }

        $label = ($this->label)? $this->label : t('Parent');

        ob_start();
        $select->display();
        $s = ob_get_clean();
        return $s;
    }
}