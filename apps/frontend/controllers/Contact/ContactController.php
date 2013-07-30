<?php
class ContactController extends FrontendBaseController {
    public function executeDefault() {
        return $this->renderComponent();
    }

    public function executeMess() {
        $this->validAjaxRequest();
    }
}