<?php
use Flywheel\Base;
use Flywheel\Factory;

class BackendSideBar extends \Flywheel\Html\Widget\Menu {
    public $viewFile = 'sidebar';

    protected function _init() {
        parent::_init();
        $this->viewPath = Base::getApp()->getController()->getTemplatePath() .DIRECTORY_SEPARATOR .'widget' .DIRECTORY_SEPARATOR;

        $this->items = array(
            array(
                'label' => t('Dashboard'),
                'url' => array('dashboard/default'),
            ),
            array(
                'label' => t('Posts Management'),
                'url' => array('post/default'),
                'items' => array(
                    array('label' => t('All Posts'),
                        'url' => array('post/default')),
                    array('label' => t('Add New'),
                        'url' => array('post/create')),
                    array('label' => t('Categories'),
                        'url' => array('category/default')),
                ),
            ),
            array(
                'label' => t('Users Management'),
                'url' => array('user/default'),
                'items' => array(
                    array(
                        'label' => t('All Users'),
                        'url' => array('user/default')
                    ),

                    array(
                        'label' => t('Create New User'),
                        'url' => array('user/create')
                    ),
                )
            ),
        );
    }

    public function end() {
        $params = $this->params;
        $params['items'] = $this->items;
        $params['deep'] = $this->deep;
        return $this->render($params);
    }
}