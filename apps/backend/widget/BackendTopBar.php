<?php
class BackendTopBar extends AdminBaseWidget {
    public $viewFile = 'top_bar';

    public function begin() {
        $this->params['user'] = BackendAuth::getInstance()->getUser();
    }
}