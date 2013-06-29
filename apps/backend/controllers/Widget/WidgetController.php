<?php
use Flywheel\Factory;

class WidgetController extends AdminBaseController {
    public function executeDefault() {
        $filter = $this->request()->get('filter', 'ARRAY', array());
        $query = \WidgetBlockBlock::read();

        if (!empty($filter['keyword'])) {
            $query->andWhere("`name` LIKE '%{$filter['keyword']}%'");
        }

        if (!empty($filter['position'])) {
            $query->andWhere("`position` = :pos")
                ->setParameter(':pos', $filter['position'], \PDO::PARAM_STR);
        }

        if (!empty($filter['status'])) {
            $query->andWhere("`status` = :status")
                ->setParameter(':status', $filter['status'], \PDO::PARAM_STR);
        }

        $widgets = $query->execute()
            ->fetchAll(\PDO::FETCH_CLASS, 'Widget', array(null, false));

        $this->view()->assign(array(
            'filter' => $filter,
            'widgets' =>$widgets
        ));

        return $this->renderComponent();
    }

    public function executeExtendForm() {
//        $this->validAjaxRequest();
        $ajax = new AjaxResponse();

        $path = $this->request()->get('path');
        $widget_id = $this->request()->get('widget_id', 'INT', 0);
        if (!($widget = \WidgetBlock::retrieveById($widget_id))) {
            $widget = new \WidgetBlock();
        }
        try {
            $widgetx = \Toxotes\Block::loadWidget($path, $widget);
        } catch(\Exception $e) {
            $ajax->type = AjaxResponse::ERROR;
            $ajax->message = t('Something was wrong!, ' .$path .' not found');
            return $this->renderText($ajax->toString());
        }

        $ajax->html = $widgetx->displayFrom();
        return $this->renderText($ajax->toString());
    }

    public function executeNew() {
        $widgetBlock = new \WidgetBlock();
        $error = array();
        if ($this->request()->isPostRequest()) {
            if ($this->_save($widgetBlock, $error)) {
                Factory::getSession()->setFlash('message', t($widgetBlock->getName() .' was saved!'));
                $this->redirect($this->createUrl('widget/default'));
            }
        }

        $extends_form = '';

        if ($widgetBlock->getPath()) {
            $widgetx = \Toxotes\Block::loadWidget($widgetBlock->getPath(), $widgetBlock);
            $extends_form = $widgetx->displayFrom($error);
        }

        $this->setView('form');
        $this->view()->assign(array(
            'widgetBlock' => $widgetBlock,
            'error' => $error,
            'extends_form' => $extends_form
        ));

        return $this->renderComponent();
    }

    public function executeEdit() {}

    public function _save(\WidgetBlock $widget, &$error) {
        $widget->hydrate($this->request()->post('input', 'ARRAY', array()));
        if ($widget->getPath()) {
            $widgetx = \Toxotes\Block::loadWidget($widget->getPath(), $widget);
            $widgetx->handlingSubmit();
        }

        if ($widget->save()) {
            return true;
        } else {
            foreach($widget->getValidationFailures() as $validationFailure) {
                $error[$validationFailure->getColumn()] = $validationFailure->getMessage();
            }
        }

        return false;
    }

    public function executeRemove() {}
}