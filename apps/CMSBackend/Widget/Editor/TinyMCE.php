<?php

use Flywheel\Factory;

class TinyMCE extends \CMSBackend\Widget\CMSBackendBaseWidget {
    protected static $_initialized = false;
    protected $_selectors = array();

    protected function _init() {
        if (!self::$_initialized) {
            $doc = Factory::getDocument();
            $doc->addJs($doc->getBaseUrl() .'../vendor/tinymce/tinymce.min.js', 'TOP');
            $doc->addJs($doc->getBaseUrl() .'../vendor/tinymce/jquery.tinymce.min.js', 'TOP');
        }
    }

    public function addSelector($selector) {
        $this->_selectors[] = $selector;
    }

    public function begin() {
        $this->addSelector($this->selector);
    }
    public function end() {
        $doc = Factory::getDocument();

        $js = 'tinymce.init({
            selector: "' .implode(array_unique($this->_selectors))."\",\n"
            .($this->width? 'width :' .$this->width .",\n": '')
            .($this->height? 'height :' .$this->height .",\n": '')
            .($this->content_css? 'content_css : "' .$this->content_css ."\",\n": '')
            .'plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "media save table directionality",
                "emoticons template paste textcolor"
            ],
            theme:"modern",
            skin:"lightgray",
            menubar : false,
            toolbar1: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media | forecolor",
            image_advtab: true,
        });';

        $doc->addJsCode($js, 'TOP', 'standard');
    }
}