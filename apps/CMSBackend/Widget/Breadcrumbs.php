<?php
use Flywheel\Base;

class Breadcrumbs extends \Flywheel\Html\Widget\Breadcrumbs {
    public $viewFile = 'breadcrumbs';

    protected function _init() {
        parent::_init();
        $this->viewPath = Base::getApp()->getController()->getTemplatePath() .DIRECTORY_SEPARATOR .'Widget' .DIRECTORY_SEPARATOR;
    }

    public function end() {
        return $this->render(array(
            'activesLink' => $this->_actives,
            'inActivesLink' => $this->_inactive,
        ));
    }
} 