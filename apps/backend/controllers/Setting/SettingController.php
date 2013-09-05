<?php

class SettingController extends AdminBaseController {
    public $error;

    public function executeDefault() {
        if ($this->request()->isPostRequest()) {
            $this->_save();
        }

        return $this->renderComponent();
    }

    private function _save() {
    }
}