<?php
require_once __DIR__.'/SelectParentTerm.php';
use Toxotes\Plugin;

class SelectItemCategory extends SelectParentTerm {
    public function begin() {
        $this->enable = Plugin::applyFilters('enable_' .$this->taxonomy .'_category', true);
        if (!$this->enable) {
            return;
        }
        $this->item_taxonomy = $this->taxonomy;
        $this->taxonomy = Plugin::applyFilters('get_category_'.$this->item_taxonomy, 'category');
        parent::begin();
    }
    public function end() {
        if (!$this->enable) {
            return;
        }

        $select = $this->form->selectOption($this->elementName, $this->selected, (array) $this->htmlOptions)
            ->addOption($this->label, '*');

        foreach ($this->terms as $term) {
            $selectName = ($term->getLevel() > 1)? str_repeat('&#8212;', $term->getLevel()-1) .$term->getName(): $term->getName();
            $select->addOption($selectName, $term->getId());
        }

        ob_start();
        echo '<div class="control-group' .(!empty($this->error)? ' error' : '') .'">
                    <div>';
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