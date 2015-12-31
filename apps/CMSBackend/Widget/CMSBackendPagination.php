<?php
use Flywheel\Base;
use Flywheel\Html\Widget\Pagination;

class CMSBackendPagination extends Pagination {
    public function __construct($render = null) {
        parent::__construct($render);
        $this->viewPath = Base::getApp()->getController()->getTemplatePath() .DIRECTORY_SEPARATOR .'Widget' .DIRECTORY_SEPARATOR;
    }
}