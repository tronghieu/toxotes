<?php
use Flywheel\Factory;

class MenuWidget extends \Toxotes\Widget {
    public $lists = array();

    public function begin() {
        $this->menu_id = $this->getParams('menu_id');
        $this->deep = $this->getParams('deep');
        $menu = \Menus::retrieveById($this->menu_id);

        if ($this->deep == 0) {
            $this->deep = 999999;
        }

        $this->_getItems($menu, $this->lists, $this->deep);
    }

    /**
     * @param \Menus $menu
     * @param array $lists
     * @param $deep
     */
    protected function _getItems($menu, &$lists, $deep) {
        $deep--;
        /** @var \Menus[] $child */
        $child = $menu->getChildren();
        if ($menu->getType() == \Menus::INTERNAL) {
            $param = json_decode($menu->getRouteParam());
        }

        if (!$child && $deep > 0
            && $menu->getType() == \Menus::INTERNAL
            && $menu->getRoute() == 'category/default'
            && @$param->fetch_child) {
            if (@$param->id) {
                $cat = Terms::retrieveById(@$param->id);
                if ($cat) {
                    $childCat = $cat->getChildren();
                    foreach($childCat as $cc) {
                        $c = new \Menus();
                        $c->setType(\Menus::INTERNAL);
                        $c->setName($cc->getName());
                        $c->setRoute('category/default');
                        $c->setRouteParam('{"id":' .$cc->getId() .'}');
                        if (!is_array($child)) {
                            $child = array();
                        }
                        $child[] = $c;
                    }
                } else {
                    return;
                }
            }

        }

        if (!$child && $deep > 0
            && $menu->getType() == \Menus::INTERNAL
            && $menu->getRoute() == 'products/category'
            && @$param->fetch_child) {
            if (@$param->id) {
                $cat = Terms::retrieveById(@$param->id);
                if ($cat) {
                    $childCat = $cat->getChildren();
                    foreach($childCat as $cc) {
                        $c = new \Menus();
                        $c->setType(\Menus::INTERNAL);
                        $c->setName($cc->getName());
                        $c->setRoute('products/category');
                        $c->setRouteParam('{"id":' .$cc->getId() .'}');
                        if (!is_array($child)) {
                            $child = array();
                        }
                        $child[] = $c;
                    }
                } else {
                    return;
                }
            }

        }

        if (!$child || $deep < 0) {
            return;
        }

        if (isset($lists['items'])) {
            $lists['items'] = array();
        }

        foreach ($child as $c) {
            if ($c->getType() == \Menus::SEPARATE) {
                $url = array('#');
            } else if ($c->getType() == \Menus::EXTERNAL) {
                $url = array($c->getLink());
            } else if ($c->getType() == \Menus::INTERNAL) {
                $param = ($c->getRouteParam())? json_decode($c->getRouteParam(), true) : array();
                $url = array($c->getRoute());
                foreach ($param as $k=>$v) {
                    $url[$k] = $v;
                }
            }

            $_item = array(
                'label' => $c->getName(),
                'url' => $url);

            $this->_getItems($c, $_item, $deep);

            $lists['items'][] = $_item;
        }
    }

    public function html() {
        $this->begin();
        $this->fetchViewPath();
        $this->fetchViewFile();

        $widget = Factory::getWidget('\Flywheel\Html\Widget\Menu', $this->getRender());

        if (isset($this->lists['items'])) {
            $widget->items = $this->lists['items'];
        }
        $widget->begin();

        $widget->viewFile = $this->viewFile;
        $widget->viewPath = preg_replace('#/+#','/',$this->viewPath);
        $buffer = $widget->render(array(
            'items' => $widget->items ,
        ));

        return $buffer;
    }
}