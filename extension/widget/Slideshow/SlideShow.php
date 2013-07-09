<?php

class SlideShow extends \Toxotes\Widget {
    public function html() {
        $this->fetchViewPath();
        $this->fetchViewFile();

        $html = $this->render();

        return $html;
    }
}