<?php
class PostController extends FrontendBaseController {
    public function executeDefault() {
        return $this->executeDetail();
    }

    public function executeDetail() {
        return $this->renderComponent();
    }
}