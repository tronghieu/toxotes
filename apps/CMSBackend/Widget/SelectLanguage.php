<?php
class SelectLanguage extends \CMSBackend\Widget\CMSBackendBaseWidget {

    public function begin() {
        $this->languages = Languages::findByPublished(1);
    }

    public function end() {
        $select = $this->form->selectOption($this->elementName, $this->selected, (array) $this->htmlOptions)
            ->addOption(t('Select Language'), '*');

        foreach ($this->languages as $lang) {
            $select->addOption($lang->getTitle(), $lang->getLangCode());
        }

        $select = \Toxotes\Plugin::applyFilters('dropdown_language', $select);

        ob_start();
        $select->display();
        $s = ob_get_clean();
        return $s;
    }
}