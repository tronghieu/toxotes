<?php
class EventsController extends FrontendBaseController {
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
            ->where('`status` = :status AND `taxonomy` = "event_manager"')
            ->setParameter(':status', 'PUBLISH', \PDO::PARAM_STR);

        //Filter
        $catId = array($cat->getId());
        foreach($child as $c) {
            $catId[] = $c->getId();
        }
        $q->andWhere('`term_id` IN (' .implode(',', $catId) .')');

        //Filter by time
        $day = $this->request()->get('day');
        $month = $this->request()->get('month');
        $year = $this->request()->get('year');
        if ($day || $month || $year) {
            if ($day) {
                $q->andWhere('DAY(`created_time`) = :day')
                    ->setParameter(':day', $day, \PDO::PARAM_STR);
            }
            if ($month) {
                $q->andWhere('MONTH(`created_time`) = :month')
                    ->setParameter(':month', $month, \PDO::PARAM_STR);
            }
            if ($year) {
                $q->andWhere('YEAR(`created_time`) = :year')
                    ->setParameter(':year', $year, \PDO::PARAM_STR);
            }
        }

        //Keyword
        if (($keyword = $this->request()->get('keyword'))) {
            $q->andWhere('`title` LIKE "%' .$keyword. '%"');
        }

        //Ordering
        $q->addOrderBy('created_time', 'DESC');

        $qCount = clone $q;

        $total = $qCount->count()->execute();

        //Paging
        $page_size = 10;
        $q->setMaxResults($page_size);
        $page = $this->request()->get('page', 'INT', 1);
        $q->setFirstResult(($page-1)*$page_size);

        $posts = $q->execute()
            ->fetchAll(\PDO::FETCH_CLASS, Posts::getPhpName(), array(null, false));

        $this->view()->assign(array(
            'page_size' => $page_size,
            'total' => $total,
            'cat' => $cat,
            'child' => $child,
            'posts' => $posts
        ));

        return $this->renderComponent();
    }

    public function executeDetail() {
        $event = Posts::retrieveById($this->request()->get('id'));
        $this->setView('detail');

        $cat = Terms::retrieveById($event->getTermId());

        //get Others
        $siblings = $cat->getSiblings();
        $siblings[] = $cat;
        foreach ($siblings as $s) {
            $ids[] = $s->getId();
            $others = Posts::read()->where('`id` != ' .$event->getId())
                    ->andWhere('`status` = "PUBLISH"')
                    ->andWhere('`term_id` IN (' .implode(',', $ids).')')
                    ->orderBy('created_time', 'DESC')
                    ->setMaxResults(5)
                    ->execute()
                    ->fetchAll(\PDO::FETCH_CLASS, Posts::getPhpName(), array(null, false));
        }

        $this->view()->assign(array(
            'event' => $event,
            'cat' => $cat,
            'others' => $others
        ));
        return $this->renderComponent();
    }
}