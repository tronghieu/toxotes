<?php
use Flywheel\Base;
use Flywheel\Factory;

class BackendSideBar extends \Flywheel\Html\Widget\Menu {
    public $viewFile = 'sidebar';

    protected function _init() {
        parent::_init();
        $this->viewPath = Base::getApp()->getController()->getTemplatePath() .DIRECTORY_SEPARATOR .'widget' .DIRECTORY_SEPARATOR;

        $this->items = array();

        $this->items[] = array(
            'label' => t('Banners'),
            'url' => array('banner/default'),
            'items' => array(
                array('label' => t('List All Banners'),
                    'url' => array('banner/default')
                ),
                array(
                    'label' => t('Banner Groups'),
                    'url' => array('category/default', 'taxonomy' => 'banner')
                ),
                array('label' => t('Add New Banner'),
                    'url' => array('banner/new')
                ),
            )
        );

        $this->dispatch('onAfterInitAdminMenu', new AdminEvent($this));
    }

    public function end() {
        $params = $this->params;
        $params['items'] = $this->items;
        $params['deep'] = $this->deep;
        return $this->render($params);
    }
}