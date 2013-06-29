<?php
class LatestNews extends \Toxotes\Widget {
    public function displayFrom($error = array()) {
        $html = parent::displayFrom($error);

        $owner = $this->getOwner();
        $property = json_decode($owner->getProperties());

        $categories = $this->_loadCategories();

        $form = new \Flywheel\Html\Form();
        $select = $form->selectOption('property[category]', @$property->category)
                    ->addOption(t('Chose Categories'), '');

        foreach($categories as $category) {
            $select->addOption(str_repeat('&#8212;', $category->getLevel()) .$category->getName(), $category->getId());
        }

        $html .= '<div class="control-group' .(isset($error['property.category'])? ' error' : '') .'">
                    <label class="control-label">' .t('Select Category') .'</label>
                    <div class="controls">' .$select->display()
                    .(isset($error['property.category'])? '<span class="help-block">' .implode('. ', $error['property.title']) .'</span>' : '')
                    .'</div>
                </div>';

        $radio = $form->radioButton('property[fetch_child_cat]', (int) @$property->fetch_child_cat)
                ->add(1, t('Yes'))
                ->add(0, t('No'));

        $html .= '<div class="control-group">
                    <label class="control-label">' .t('Include child category') .'</label>
                    <div class="controls">' .$radio->display() .'</div>
                </div>';

        return $html;
    }

    /**
     * @return Terms[]
     */
    private function _loadCategories() {
        $root = Terms::retrieveRoot('category');
        return $root->getDescendants();
    }
}