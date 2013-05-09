<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 5/10/13
 * Time: 1:44 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Flywheel\Html\Widget;


use Flywheel\Controller\Widget;
use Flywheel\Factory;
use Flywheel\Html\Html;

class Breadcrumbs extends Widget {
    public $links=array();

    public $htmlOptions = array();

    protected $_actives = array();

    protected $_inactive;

    public $activeLinkTemplate='<a href="{url}" {htmlOptions}>{label}</a>';

    public $inactiveLinkTemplate='<span>{label}</span>';

    public $separator = ' &raquo; ';

    public function begin() {
        foreach ($this->links as $label => $link) {
            $link = array_merge_recursive(array('url' => '', 'htmlOptions' => array()), $link);
            if (is_string($label)) {
                $this->_actives[] = array('label' => $label,
                                    'url' => is_array($link['url'])? Factory::getRouter()->createUrl($link['url'])
                                        : $link['url'],
                                    'htmlOptions' => $link['htmlOptions']);
            } else {
                $this->_inactive[] = $link;
            }
        }
    }

    public function end() {
        $s = '';
        for ($i = 0, $size = sizeof($this->_actives); $i < $size; ++$i) {
            $s .= strstr($this->activeLinkTemplate, array(
                '{url}' => $this->_actives[$i]['url'],
                '{label}' => $this->_actives[$i]['label'],
                '{htmlOptions}' => Html::serializeHtmlOption($this->_actives[$i]['htmlOptions'])
            ));

            $s .= $this->separator;
        }

        for ($i = 0, $size = sizeof($this->_inactives); $i < $size; ++$i) {

        }

        echo $s;
    }
}