<?php
use Flywheel\Base;

class MobileNavigator extends \Flywheel\Html\Widget\Menu {
    public $viewFile = 'mobile_navigator';

    protected function _init()
    {
        parent::_init();
        $this->viewPath = Base::getApp()->getController()->getTemplatePath() . DIRECTORY_SEPARATOR . 'Widget' . DIRECTORY_SEPARATOR;
        $this->items = \CMSBackend\Library\MobileMenu::$items;
        $this->items = \Toxotes\Plugin::applyFilters('custom_admin_mobile_nav', $this->items);
    }

    public function end() {
        return $this->render([
            'items' => $this->items
        ]);
    }
}