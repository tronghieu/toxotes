<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 4/23/13
 * Time: 11:41 AM
 * To change this template use File | Settings | File Templates.
 */

use Flywheel\Controller\WebController;
use Flywheel\Controller\Widget;

abstract class AdminBaseWidget extends Widget {
    protected function _init() {
        /** @var WebController $controller */
        $controller = \Flywheel\Base::getApp()->getController();
        $this->viewPath = $controller->getTemplatePath() .DIRECTORY_SEPARATOR .'widget' .DIRECTORY_SEPARATOR;
        if (null == $this->viewFile) {
            $this->viewFile = get_class($this);
        }
    }
}