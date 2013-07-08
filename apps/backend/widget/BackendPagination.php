<?php
use Flywheel\Base;
use Flywheel\Html\Widget\Pagination;

class BackendPagination extends Pagination {
    public function __construct($render = null) {
        parent::__construct($render);
        $this->viewPath = Base::getApp()->getController()->getTemplatePath() .DIRECTORY_SEPARATOR .'widget' .DIRECTORY_SEPARATOR;
    }
}