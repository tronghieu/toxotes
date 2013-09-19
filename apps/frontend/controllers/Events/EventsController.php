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
            ->where('`status` = :status AND `taxonomy` = "event_manager" AND `is_draft` = 0')
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
                    ->andWhere('`is_draft` = 0')
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

    public function executeCalendar() {
        $this->setView('calendar');
        $calendar = new CalendR\Calendar();

        $month = $this->request()->get('month');
        $year = $this->request()->get('year');
        $day = $this->request()->get('day');

        if (!$month) {$month = date('m');}
        if (!$year) {$year = date('Y');}
        if (!$day) {$day = date('d');}

        $term = \Terms::retrieveById($this->request()->get('eventsId', 'INT', 0));
        $fetchChild = $this->request()->get('fetchChild', 'BOOLEAN', false);

        $res = new AjaxResponse();
        if (!$term) {
            $res->type = 0;
            $res->message = Cms::t('Term not found with id:' .$this->request()->get('eventsId', 'INT', 0));
            return $this->renderText($res->toString());
        }

        $terms = ($fetchChild)? $term->getBranch() : array($term);
        foreach ($terms as $t) {
            $ids[] = $t->getId();
        }

        $q = Posts::read();

        $events = $q->select('COUNT(`id`) AS result, DAY(`created_time`) AS day, MONTH(`created_time`) AS month')
            ->where('`status` = :status')
            ->andWhere('`is_draft` = 0')
            ->andWhere('`term_id` IN (' .implode(',', $ids) .')')
            ->setParameter(':status', 'PUBLISH', \PDO::PARAM_STR)
            ->andWhere('MONTH(`created_time`) = :month')
            ->setParameter(':month', $month, \PDO::PARAM_STR)
            ->andWhere('YEAR(`created_time`) = :year')
            ->setParameter(':year', $year, \PDO::PARAM_STR)
            ->groupBy('DAY(`created_time`)')
            ->execute()
            ->fetchAll(\PDO::FETCH_ASSOC);

        $list = array();
        for($i = 0, $size = sizeof($events); $i < $size; ++$i) {
            if ($events[$i]['day'] < 10) {
                $events[$i]['day'] = '0'.$events[$i]['day'];
            }

            if ($events[$i]['month'] < 10) {
                $events[$i]['month'] = '0'.$events[$i]['month'];
            }

            $list[$events[$i]['month'] .'_' .$events[$i]['day']] = $events[$i]['result'];
        }

        $html = $this->renderPartial(array(
            'current_day' => $day,
            'current_month' => $month,
            'current_year' => $year,
            'calendar' => $calendar,
            'route' => 'events/default',
            'list' => $list,
            'route_params' => $this->request()->get('params', 'ARRAY', array())
        ));

        $res->type = AjaxResponse::SUCCESS;
        $res->html = $html;
        return $this->renderText($res->toString());
    }
}