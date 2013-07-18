<?php
use Flywheel\Base;

class FrontendBaseWidget extends \Flywheel\Controller\Widget {
    public function __construct($render = null) {
        parent::__construct($render);

        $this->viewPath = Base::getApp()->getController()->getTemplatePath() .'/widget/';
    }
}