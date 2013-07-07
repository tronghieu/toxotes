<?php
use Flywheel\Base;

class BackendTopBar extends \Flywheel\Html\Widget\Menu {
    public $viewFile = 'top_bar';

    protected function _init() {
        parent::_init();

        $this->viewPath = Base::getApp()->getController()->getTemplatePath() .DIRECTORY_SEPARATOR .'widget' .DIRECTORY_SEPARATOR;

        $this->items = array(
            array(
                'label' => t('Dashboard'),
                'url' => array('dashboard/default'),
            ),
            /*array(
                'label' => t('Menu'),
                'url' => array('menu/default'),
                'items' => array(
                    array('label' => t('Menu List'),
                        'url' => array('menu/default'))
                ),
            ),*/
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

                    array(
                        'label' => t('Roles'),
                        'url' => array('roles/default')
                    ),
                )
            ),
            /*array(
                'label' => t('Setting'),
                'url' => array('setting/default'),
            ),*/
        );

        $menuGs = Menu::getMenuGroup();
        if (!empty($menuGs)) {
            foreach($menuGs as $menuG) {
                $this->items[1]['items'][] = array(
                    'label'=> $menuG->getName(),
                    'url' => array('menu/default', 'id' => $menuG->getId()),
                    'items' => array(
                        array('label' => t('Add menu'),
                            'url' => array('menu/add', 'id' => $menuG->getId()))
                    ),
                );
            }
        }

        $this->items = \Toxotes\Plugin::applyFilters('after_init_admin_main_nav', $this->items);
    }

    public function end() {
        return $this->render(array(
            'user' => BackendAuth::getInstance()->getUser(),
            'items' => $this->items,
            'deep' => $this->deep
        ));
    }
}