<?php
class SelectWidgetPosition extends AdminBaseWidget {
    public function begin() {
        $this->pos = SystemFields::findByType('block_position');
    }

    public function end() {
        if ($this->form) {
            $this->form = new Flywheel\Html\Form();
        }

        $select = $this->form->selectOption($this->elementName, $this->select, (array) $this->htmlOptions)
            ->addOption(t('Select position'), '');

        foreach ($this->pos as $pos) {
            /** @var \SystemFields $pos */
            $select->addOption($pos->getTitle(), $pos->getValue());
        }

        return $select->display();
    }
}