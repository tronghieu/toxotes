<?php

class OtherNews extends FrontendBaseWidget {
    public function begin() {
        $this->viewFile = 'other_news';

        $parent = Terms::retrieveById($this->parent_id);
        $except = Terms::retrieveById($this->except);
        $branchOfExcept = $except->getBranch();
        $q = Terms::read();
        $c = array();
        foreach ($branchOfExcept as $_c) {
            $c[] = $_c->getId();
        }

        $q->where('`id` NOT IN (' .implode(',', $c) .')');

        $others = $parent->getDescendants($q);

        $c = array();
        if ($others) {
            foreach ($others as $o) {
                $c[] = $o->getId();
            }
        }

        $this->lists = Posts::read()->where('`status` = :status AND `is_draft` = 0')
                        ->andWhere('`term_id` IN (' .implode(',', $c) .')')
                        ->setParameter(':status', 'PUBLISH', \PDO::PARAM_STR)
                        ->orderBy('modified_time', 'DESC')
                        ->setMaxResults(5)
                        ->execute()
                        ->fetchAll(\PDO::FETCH_CLASS, 'Posts', array(null, false));
    }
}