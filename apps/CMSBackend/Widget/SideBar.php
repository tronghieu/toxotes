<?php

use Flywheel\Base;

class SideBar extends \Flywheel\Html\Widget\Menu {
    public $viewFile = 'sidebar';

    protected function _init() {
        parent::_init();
        $this->viewPath = Base::getApp()->getController()->getTemplatePath() .DIRECTORY_SEPARATOR .'Widget' .DIRECTORY_SEPARATOR;

        $this->items = \Toxotes\Plugin::applyFilters('custom_admin_left_sidebar', $this->items);
    }

    public function end() {
        \CMSBackend\Library\MobileMenu::addMenu($this->items);
        $params = $this->params;
        $params['items'] = $this->items;
        $params['deep'] = $this->deep;
        return $this->render($params);
    }
} 