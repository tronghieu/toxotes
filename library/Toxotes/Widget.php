<?php
namespace Toxotes;

abstract class Widget extends \Flywheel\Controller\Widget {
    public $controllerTemplate;

    protected $_name;

    protected $_params;

    public function setName($name) {
        $this->_name = $name;
    }

    public function getName() {
        if (!$this->_name) {
            $this->_name = get_class($this);
        }

        return $this->_name;
    }
    /**
     * @var \WidgetBlock
     */
    protected $_owner;

    public function setOwner(\WidgetBlock $w) {
        $this->_owner = $w;
    }

    /**
     * @return \WidgetBlock
     */
    public function getOwner() {
        return $this->_owner;
    }

    public function displayFrom($error = array()) {
        $html = '';

        $property = json_decode($this->getOwner()->getProperties());

        $html .= '<div class="control-group' .(isset($error['property.title'])? ' error' : '') .'">
                    <label class="control-label">' .t('Block Title') .'</label>
                    <div class="controls">
                        <input name="property[title]" value="' . @$property->title .'">';

        if (isset($error['property.title'])) {
            $html .= '<span class="help-block">' .implode('. ', $error['property.title']) .'</span>';
        }

        $html .='</div>
                </div>';

        return $html;
    }

    public function handlingSubmit() {}

    abstract function html();

    public function getParams($param) {
        if (empty($this->_params)) {
            if ($this->getOwner() && $this->getOwner()->properties) {
                $this->_params = json_decode($this->getOwner()->properties, true);
            }
        }

        return (isset($this->_params[$param])? $this->_params[$param] : null);
    }

    public function setParams($param, $value) {
        if (empty($this->_params)) {
            if ($this->getOwner() && $this->getOwner()->properties) {
                $this->_params = json_decode($this->getOwner()->properties, true);
            }
        }

        $this->_params[$param] = $value;
    }

    public function fetchViewPath() {
        $controllerTemplate = $this->controllerTemplate .$this->getName();
        if ($this->getParams('view')) {
            $view = $this->getParams('view');
        } else {
            $view = 'default';
        }

        if(file_exists($controllerTemplate .'/' .$view .'.phtml')) {
            $this->viewPath = $controllerTemplate .'/';
        }

        if (file_exists(ROOT_PATH.'/extension/widget/' .$this->getName() .'/template/' .$view.'.phtml')) {
            $this->viewPath = ROOT_PATH.'/extension/widget/' .$this->getName() .'/template/';
        }
    }

    public function fetchViewFile() {
        if ($this->getParams('view')) {
            $view = $this->getParams('view');
        } else {
            $view = 'default';
        }

        $this->viewFile = $view;
    }
}