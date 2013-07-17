<?php
class CategoryController extends FrontendBaseController {
    public function executeDefault() {
        if (!($cat = Terms::retrieveById($this->request()->get('id')))) {
            $this->raise404();
        }

        $viewProp = $cat->getProperty('cat_view');
        if ($viewProp) {
            $this->setView($viewProp->getValue());
        }

        $child = ($cat->getDescendants());

        $q = Posts::read()
                ->where('`status` = :status')
                ->setParameter(':status', 'PUBLISH', \PDO::PARAM_STR);

        //Filter
        $catId = array($cat->getId());
        foreach($child as $c) {
            $catId[] = $c->getId();
        }
        $q->andWhere('`term_id` IN (' .implode(',', $catId) .')');

        //Ordering
        $orderingProp = $cat->getProperty('post_ordering');
        if ($orderingProp) {
            switch($orderingProp->getValue()) {
                case 'created_time' :
                    $q->addOrderBy('created_time');
                    break;
                case 'ordering' :
                    $q->addOrderBy('ordering');
                    break;
                case 'modified_time':
                case 'default' :
                default :
                    $q->addOrderBy('modified_time', 'DESC');
                    break;
            }
        } else {
            $q->addOrderBy('modified_time', 'DESC');
        }

        //Paging
        $pageSizeProp = $cat->getProperty('page_size');
        if ($pageSizeProp) {
            if (-1 != $pageSizeProp->getValue()) {
                $q->setMaxResults($pageSizeProp->getValue());
                $page = $this->request()->get('page', 'INT', 1);
                $q->setFirstResult($page-1);
            }
        } else {
            $q->setMaxResults(25);
            $page = $this->request()->get('page', 'INT', 1);
            $q->setFirstResult($page-1);
        }

        $posts = $q->execute()
                    ->fetchAll(\PDO::FETCH_CLASS, Posts::getPhpName(), array(null, false));

        $this->view()->assign(array(
            'cat' => $cat,
            'child' => $child,
            'posts' => $posts
        ));

        return $this->renderComponent();
    }
}