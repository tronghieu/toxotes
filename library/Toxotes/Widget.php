<?php
namespace Toxotes;

class Widget extends \Flywheel\Controller\Widget {
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
}