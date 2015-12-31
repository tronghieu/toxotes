<?php
namespace CMSBackend\Widget;

use Flywheel\Controller\Web;
use Flywheel\Controller\Widget;

class CMSBackendBaseWidget extends Widget {
    protected function _init() {
        /** @var Web $controller */
        $controller = \Flywheel\Base::getApp()->getController();
        $this->viewPath = $controller->getTemplatePath() .DIRECTORY_SEPARATOR .'Widget' .DIRECTORY_SEPARATOR;
        if (null == $this->viewFile) {
            $this->viewFile = get_class($this);
        }
    }
} 