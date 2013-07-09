<?php
namespace Toxotes;

use Flywheel\Controller\WebController;

abstract class Controller extends WebController {
    /**
     * @var \Languages[]
     */
    public $languages = array();

    /**
     * @var \Languages
     */
    public $currentLang;

    public function renderBlock($position) {
        $lang = ($this->currentLang)? $this->currentLang->getLangCode(): null;

        $widgets = Block::getBlocksByPosition($position, $lang);

        $html = '';

        foreach ($widgets as $widget) {
            $widget->controllerTemplate = $this->getTemplatePath() .'/widget/';
            $html .= $widget->html();
        }

        return $html;
    }

    public function block($position) {
        echo $this->renderBlock($position);
    }
}