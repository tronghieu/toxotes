<?php
namespace Frontend\Controller;
use Frontend\Controller\FrontendBase;
class Frontend extends FrontendBase{

    public function executeDefault() {
        $this->setView('Home/default');
        return $this->renderComponent();
    }
}
