<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 6/6/13
 * Time: 5:02 PM
 * To change this template use File | Settings | File Templates.
 */

class SelectLanguage extends AdminBaseWidget {
    protected function _init() {
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
        echo '<div class="control-group">
                    <label class="control-label">' .t('Language') .'</label>
                    <div class="controls">';
        $select->display();
        echo '</div></div>';
        $s = ob_get_clean();
        return $s;
    }
}