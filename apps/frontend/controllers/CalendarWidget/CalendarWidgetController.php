<?php
use Toxotes\Cms;

class CalendarWidgetController extends FrontendBaseController {
    public function executeDefault() {
        $calendar = new CalendR\Calendar();

        $month = $this->request()->get('month', 'STRING', date('m'));
        $year = $this->request()->get('year', 'STRING', date('Y'));
        $day = $this->request()->get('day', 'STRING', date('d'));

        $term = \Terms::retrieveById($this->request()->get('termId', 'INT', 0));
        $fetchChild = $this->request()->get('fetchChild', 'BOOLEAN', false);

        $res = new AjaxResponse();
        if (!$term) {
            $res->type = 0;
            $res->message = Cms::t('Term not found with id:' .$this->request()->get('term_id', 'INT', 0));
            return $this->renderText($res->toString());
        }

        $html = $this->renderPartial(array(
            'current_day' => $day,
            'current_month' => $month,
            'current_year' => $year,
            'calendar' => $calendar,
            'route' => $this->request()->get('route', 'STRING', 'category/default'),
            'route_params' => $this->request()->get('params', 'ARRAY', array())
        ));

        $res->type = AjaxResponse::SUCCESS;
        $res->html = $html;
        return $this->renderText($res->toString());
    }
}