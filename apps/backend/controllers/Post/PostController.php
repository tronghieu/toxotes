<?php

class PostController extends AdminBaseController {
    public function executeDefault() {
        $type = $this->request()->get('type', 'STRING', 'post');
        $this->dispatch('onBeginListingItem', new AdminEvent($this));

        $this->dispatch('onAfterListingItem', new AdminEvent($this));

        return $this->renderComponent();
    }

    public function executeCreate() {}

    public function executeEdit() {}

    protected function _save(Items &$item) {}
}