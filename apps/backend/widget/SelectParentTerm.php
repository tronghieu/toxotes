<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 6/7/13
 * Time: 1:59 PM
 * To change this template use File | Settings | File Templates.
 */

class SelectParentTerm extends AdminBaseWidget {
    protected function _init() {
    }

    public function begin() {
        $root = Terms::retrieveRoot($this->taxonomy);
        $this->terms = $root->getDescendants();
    }

    public function end() {
        $select = $this->form->selectOption($this->elementName, $this->selected, (array) $this->htmlOptions)
            ->addOption(t('Select Parent'), '*');

        foreach ($this->terms as $term) {
            $selectName = ($term->getLevel() > 1)? str_repeat('&nbsp;', $term->getLevel()-1) .'-' .$term->getName(): $term->getName();
            $select->addOption($selectName, $term->getId());
        }

        $select = \Toxotes\Plugin::applyFilters('dropdown_language', $select);

        ob_start();
        echo '<div class="control-group' .(!empty($this->error)? ' error' : '') .'">
                    <label class="control-label">' .t('Parent') .' (*) </label>
                    <div class="controls">';
        $select->display();
        echo '</div>';
        if (!empty($this->error)) {
            if (!is_array($this->error)) {
                $this->error = implode('. ', $this->error);
            }
            echo '<span class="help-block">' .implode('. ', $this->error) .'</span>';
        }
        echo '</div>';
        $s = ob_get_clean();
        return $s;
    }
}