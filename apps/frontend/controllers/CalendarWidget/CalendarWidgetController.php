<?php
class CalendarWidgetController extends FrontendBaseController {
    public function executeDefault() {

        $month = $this->request()->get('month', 'STRING', date('m'));
        $year = $this->request()->get('year', 'STRING', date('Y'));

        $term = \Terms::retrieveById($this->request()->get('termId', 'INT', 0));
        $fetchChild = $this->request()->get('fetchChild', 'BOOLEAN', false);

        $res = new AjaxResponse();
        if (!$term) {
            $res->type = 0;
            $res->message = t('Term not found with id:' .$this->request()->get('term_id', 'INT', 0));
            return $this->renderText($res->toString());
        }

        $html = $this->renderPartial();
        $res->type = AjaxResponse::SUCCESS;
        $res->html = $html;
        return $this->renderText($res->toString());
    }
}