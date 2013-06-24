<?php

use Flywheel\Factory;

class TinyMCE extends AdminBaseWidget {
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
            .($this->heigth? 'height :' .$this->heigth .",\n": '')
            .($this->content_css? 'content_css : "' .$this->content_css ."\",\n": '')
            .'plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | forecolor backcolor emoticons",
            image_advtab: true,
        });';

        $doc->addJsCode($js, 'TOP', 'standard');
    }
}