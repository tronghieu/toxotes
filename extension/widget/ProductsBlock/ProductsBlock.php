<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 2/10/15
 * Time: 2:36 PM
 */

class ProductsBlock extends \Toxotes\Widget {
    public function begin() {
        $terms = $this->getParams('terms');
        $ordering = $this->getParams('ordering');
        $fetchChild = $this->getParams('fetch_child', false);
        $limit = $this->getParams('limit');
        $q = \Items::select()
                ->where('`is_draft` = 0 AND `status` = :status')
                ->setParameter(':status', 'ACTIVE', \PDO::PARAM_STR);

        if (!empty($ordering)) {
            foreach($ordering as $_o) {
                $q->addOrderBy(@$_o['field'], @$_o['order']);
            }
        } else {
            $q->orderBy('created_time', 'DESC');
        }

        if ($limit) {
            $q->setMaxResults((int) $limit);
        }

        if (is_array($terms) && !empty($terms)) {
            $t = $terms;
            if ($fetchChild) {
                foreach($terms as $term_id) {
                    if (($term = \Terms::retrieveById($term_id))) {
                        $descendants = (array) $term->getDescendants();
                        foreach($descendants as $d) {
                            $t[] = $d->getId();
                        }
                        unset($d);
                    }
                }
            }

            $terms = $t;

            $q->andWhere('`cat_id` IN (' .implode(', ', $terms) .')');
        } elseif(is_scalar($terms) && is_numeric($terms)) {
            $t = [$terms];
            if (($term = \Terms::retrieveById($terms))) {
                if ($fetchChild) {
                    $descendants = (array) $term->getDescendants();
                    foreach($descendants as $d) {
                        $t[] = $d->getId();
                    }
                    unset($d);
                }
            }

            if (sizeof($t) > 1) {
                $q->andWhere('`cat_id` IN (' .implode(', ', $t) .')');
            } else {
                $q->andWhere('`cat_id` = :term_id')
                    ->setParameter(':term_id', $terms, \PDO::PARAM_INT);
            }
        }

        $this->items = $q->execute();
    }

    public function html() {
        $this->begin();
        $this->fetchViewPath();
        $this->fetchViewFile();

        $this->params['widget'] = $this;

        return $this->render($this->params);
    }
}