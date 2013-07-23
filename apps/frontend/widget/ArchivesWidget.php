<?php
class ArchivesWidget extends FrontendBaseWidget {
    public $viewFile = 'archives';

    public $list = array();
    public $calendar;
    public $year;

    public function begin() {
        $this->year = ($this->year)? $this->year : date('Y');

        if (($cat = \Terms::retrieveById($this->cat_id))) {
            $calendar = new \CalendR\Calendar();
            $year = $calendar->getYear($this->year);

            $cat_ids = array();
            $branches = $cat->getBranch();

            foreach ($branches as $branch) {
                $cat_ids[] = $branch->getId();
            }


            $result = $query = Posts::read()
                ->select('COUNT(`id`) AS result, MONTH(`created_time`) AS month')
                ->where('`status` = :status')
                ->andWhere('`term_id` IN (' .implode(',', $cat_ids) .')')
                ->setParameter(':status', 'PUBLISH', \PDO::PARAM_STR)
                ->andWhere('YEAR(`created_time`) = :year')
                ->setParameter(':year', $year->format('Y'), \PDO::PARAM_STR)
                ->groupBy('YEAR(`created_time`)')
                ->addGroupBy('MONTH(`created_time`)')
                ->execute()
                ->fetchAll(\PDO::FETCH_ASSOC);

            for($i = 0, $size = sizeof($result); $i < $size; ++$i) {
                if ($result[$i]['month'] < 10) {
                    $result[$i]['month'] = '0'.$result[$i]['month'];
                }
                $this->list[$result[$i]['month']] = $result[$i]['result'];
            }

            $this->calendar = $calendar;
            $this->year = $year;
        }
    }

    public function end() {
        return $this->render(array('list' => $this->list,
                                'calendar' => $this->calendar,
                                'year' => $this->year,
                                'cat_id' => $this->cat_id
        ));
    }
}