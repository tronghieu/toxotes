<?php
use CMSBackend\Library\CMSBackendAuth;
use Flywheel\Base;
use Flywheel\Html\Widget\Menu;

class Navigator extends Menu {
    public $viewFile = 'navigator';
    protected $_menus = [
        'dashboard' => [
            'label' => 'Dashboard',
            'url' => ['dashboard/default'],
            'items' => []
        ],
        'menu_widget' => [
            'label' => 'Menu Widget',
            'url' => '#',
            'items' => []
        ],

        'posts' => [
            'label' => 'Posts',
            'url' => '#',
            'items' => []
        ],

        'content' => [
            'label' => 'Site Content',
            'url' => '#',
            'items' => []
        ]
    ];

    protected function _init() {
        parent::_init();
        $this->viewPath = Base::getApp()->getController()->getTemplatePath() .DIRECTORY_SEPARATOR .'Widget' .DIRECTORY_SEPARATOR;

        //fuck it
        foreach($this->_menus as $m => $content) {
            $this->_menus[$m]['label'] = t($this->_menus[$m]['label']);
        }

        //Menu Widget
        $this->_addChildMenu('menu_widget', [
            'label' => t('Menu List'),
            'url' => ['menu/default']
        ]);

        $this->_addChildMenu('menu_widget', [
            'label' => t('Add Menu'),
            'url' => ['menu/create']
        ]);

        //Post
        $this->_addChildMenu('posts', [
            'label' => t('All Posts'),
            'url' => ['post/default'],
        ]);
        $this->_addChildMenu('posts', [
            'label' => t('Compose New'),
            'url' => ['post/create'],
        ]);
        $this->_addChildMenu('posts', [
            'label' => t('Categories'),
            'url' => ['category/default', 'taxonomy' => 'category'],
        ]);

        $this->_addSiteContentMenu();

        $this->_addProductsMenu();

        $this->items = \Toxotes\Plugin::applyFilters('after_init_admin_main_nav', $this->items);

        $this->_addSystemMenu();

        $this->_buildMenu();
    }

    private function _addChildMenu($parent, $child) {
        $this->_menus[$parent]['items'][] = $child;
    }

    private function _buildMenu() {
        foreach($this->_menus as $m) {
            if (!empty($m['items']) || (isset($m['url']) && $m['url'] != '#')) {
                $this->items[] = $m;
            }
        }
    }

    public function end() {
        \CMSBackend\Library\MobileMenu::addMenu($this->items);
        return $this->render(array(
            'user' => CMSBackendAuth::getInstance()->getUser(),
            'items' => $this->items,
            'deep' => $this->deep
        ));
    }

    private function _addProductsMenu()
    {
        $this->_menus['products'] = [
            'label' => t('Products'),
            'url' => '#',
            'items' => []
        ];

        $this->_addChildMenu('products', [
            'label' => t('Items'),
            'url' => ['items/default'],
        ]);

        $this->_addChildMenu('products', [
            'label' => t('Add Item'),
            'url' => ['items/create'],
        ]);

        $this->_addChildMenu('products', [
            'label' => t('Category'),
            'url' => ['category/default', 'taxonomy' => 'product'],
        ]);

        $this->_addChildMenu('products', [
            'label' => t('Orders'),
            'url' => ['order/default'],
        ]);
    }

    private function _addSystemMenu()
    {
        $this->_menus['system'] = [
            'label' => t('System'),
            'url' => '#',
            'items' => []
        ];

        //User menu
        $user_menus = [
            'label' => t('Users'),
            'url' => '#',
            'items' => []
        ];

        //need for permission assign
        $user_menus['items'][] = [
            'label' => t('Users List'),
            'url' => ['user/default'],
        ];
        $user_menus['items'][] = [
            'label' => t('Create New'),
            'url' => ['user/create'],
        ];
        $user_menus['items'][] = [
            'label' => t('Roles'),
            'url' => ['role/default'],
        ];

        $this->_addChildMenu('system', $user_menus);
        $this->_addChildMenu('system', [
            'label' => t('Settings'),
            'url' => ['system_setting']
        ]);

    }

    private function _addSiteContentMenu()
    {
        //Banner menu
        $banner_menu = [
            'label' => t('Banner'),
            'url' => '#',
            'items' => []
        ];

        //need for permission assign
        $banner_menu['items'][] = [
            'label' => t('Banners'),
            'url' => ['banner/default'],
        ];
        $banner_menu['items'][] = [
            'label' => t('Created New'),
            'url' => ['banner/new'],
        ];
        $banner_menu['items'][] = [
            'label' => t('Banners Group'),
            'url' => ['category/default', 'taxonomy' => 'banner'],
        ];

        $this->_addChildMenu('content', $banner_menu);
    }
} 