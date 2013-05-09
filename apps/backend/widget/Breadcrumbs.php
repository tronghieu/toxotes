<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 5/10/13
 * Time: 2:49 AM
 * To change this template use File | Settings | File Templates.
 */

use Flywheel\Base;

class Breadcrumbs extends \Flywheel\Html\Widget\Breadcrumbs {
    public function end() {
        $this->viewPath = Base::getApp()->getController()->getTemplatePath() .DIRECTORY_SEPARATOR .'widget' .DIRECTORY_SEPARATOR;
        $this->viewFile = 'breadcrumbs';
        echo $this->render(array(
            'activesLink' => $this->_actives,
            'inActivesLink' => $this->_inactive,
        ));
    }
}