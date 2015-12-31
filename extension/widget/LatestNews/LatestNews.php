<?php
class LatestNews extends \Toxotes\Widget {
    /** @var Posts[]  */
    public $list = array();

    public function displayFrom($error = array()) {
        $html = parent::displayFrom($error);

        $owner = $this->getOwner();
        $property = json_decode($owner->getProperties());

        $categories = $this->_loadCategories();

        $form = new \Flywheel\Html\Form();
        $select = $form->selectOption('property[category]', @$property->category)
                    ->addOption(t('Chose Categories'), '');

        foreach($categories as $category) {
            $select->addOption(str_repeat('&#8212;', $category->getLevelValue()) .$category->getName(), $category->getId());
        }

        ob_start();

        echo '<div class="control-group' .(isset($error['property.category'])? ' error' : '') .'">
                    <label class="control-label">' .t('Select Category') .'</label>
                    <div class="controls">' .$select->display()
                    .(isset($error['property.category'])? '<span class="help-block">' .implode('. ', $error['property.title']) .'</span>' : '')
                    .'</div>
                </div>';

        $radio = $form->radioButton('property[fetch_child_cat]', (int) @$property->fetch_child_cat)
                ->add(1, t('Yes'))
                ->add(0, t('No'));

        echo '<div class="control-group">
                    <label class="control-label">' .t('Include child category') .'</label>
                    <div class="controls">' .$radio->display() .'</div>
                </div>';

        $html .= ob_get_clean();

        return $html;
    }

    /**
     * @return Terms[]
     */
    private function _loadCategories() {
        $root = Terms::retrieveRoot('category');
        return $root->getDescendants();
    }

    public function begin() {
        $termId = $this->getParams('term_id');
        $ordering = $this->getParams('ordering');
        $fetchChild = $this->getParams('fetch_child', false);

        $q = Posts::read()
            ->where('`status`=:status AND `is_draft` = 0')
            ->setParameter(':status', 'PUBLISH', \PDO::PARAM_STR);

        $term = Terms::retrieveById($termId);
        if (!$term) {
            return;
        }

        if ($fetchChild) {
            $child = $term->getDescendants();
            $ids = array($term->getId());
            foreach($child as $_c) {
                $ids[] = $_c->getId();
            }
            $q->andWhere('`term_id` IN (' .implode(',', $ids) .')');
        } else {
            $q->andWhere('`term_id`=:term_id')
                ->setParameter(':term_id', $term->getId(), \PDO::PARAM_INT);
        }

        //limit
        $limit = $this->getParams('limit');
        if ($limit) {
            $q->setMaxResults((int) $limit);
        }

        if ($ordering) {
            foreach($ordering as $_ordering) {
                $q->addOrderBy($_ordering['field'], $_ordering['order']);
            }
        } else {
            $q->addOrderBy('modified_time', 'DESC');
        }

        $this->list = $q->execute()->fetchAll(\PDO::FETCH_CLASS, 'Posts', array(null, false));
    }

    public function html() {
        $this->begin();
        $this->fetchViewPath();
        $this->fetchViewFile();

        return $this->render(array(
            'widget' => $this
        ));
    }
}