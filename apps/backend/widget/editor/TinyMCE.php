<?php

use Flywheel\Factory;

class TinyMCE extends AdminBaseWidget {
    protected function _init() {
        $doc = Factory::getDocument();
        $doc->addJs($doc->getBaseUrl() .'../vendor/tinymce/js/');
    }

    public function begin() {}
    public function end() {}
}