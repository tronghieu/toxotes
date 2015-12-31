<?php

use Flywheel\Factory;

class SummerNote extends \CMSBackend\Widget\CMSBackendBaseWidget {
    protected static $_initialized = false;
    protected $_selectors = array();

    protected function _init() {
        if (!self::$_initialized) {
            $doc = Factory::getDocument();
            $doc->addJs($doc->getBaseUrl() .'../vendor/summernote/summernote.min.js', 'TOP');
            $doc->addJs($doc->getBaseUrl() .'../vendor/summernote/plugin/summernote-ext-fontstyle.js', 'TOP');
            $doc->addJs($doc->getBaseUrl() .'../vendor/summernote/plugin/summernote-ext-video.js', 'TOP');
            $doc->addCss($doc->getBaseUrl() .'../vendor/summernote/summernote.css');
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

        $opt = array_merge([
            'focus' => false,
            'styleWithSpan' => false,
            'maximumImageFileSize' => ini_get('upload_max_filesize')*1e+6,
            'toolbar' => [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['font-style', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'video', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['undo', 'redo', 'help']]
            ]
        ], [
            'height' => $this->height,
        ]);

        $js = '';

        $opt = json_encode($opt);
        $opt = str_replace('}', ', onImageUpload: function(files, editor, welEditable) {
                    media_upload(files[0],editor,welEditable);
                }
            }', $opt);
        foreach($this->_selectors as $selector) {
            $js .= '$("' .$selector .'").summernote(
                ' .$opt .'
            );';
            /*$js .= '$("' .$selector .'").summernote({
                onImageUpload: function(files, editor, welEditable) {
                    media_upload(files[0],editor,welEditable);
                }
            });';*/
        }

        $doc->addJsCode($js);
    }
}