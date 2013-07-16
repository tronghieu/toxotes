<?php
namespace Toxotes;

use Flywheel\Controller\WebController;
use Flywheel\Factory;

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

    /**
     * shortcut call \Flywheel\Router\WebRouter::createUrl() method
     * @see \Flywheel\Router\WebRouter::createUrl()
     * @param $route
     * @param array $params
     * @param string $ampersand
     * @return mixed
     */
    public function createUrl($route, $params = array(), $ampersand = '&') {
        $route = trim($route, '/');
        if ('post/detail' == $route) {
            if ($params['id'] && ($post = \Posts::retrieveById($params['id']))) {
                $params['slug'] = $post->getSlug();
            }

            if ($this->currentLang && sizeof($this->languages) > 1) {
                $params['lang'] = $this->currentLang->getLangCode();
            }
        } else if ('category/default' == $route) {
            if ($params['id'] && ($term = \Terms::retrieveById($params['id']))) {
                $params['slug'] = $term->getSlug();
            }

            if ($this->currentLang && sizeof($this->languages) > 1) {
                $params['lang'] = $this->currentLang->getLangCode();
            }
        } else if ('event/default' == $route) {
            if ($params['id'] && ($term = \Terms::retrieveById($params['id']))) {
                $params['slug'] = $term->getSlug();
            }

            if ($this->currentLang && sizeof($this->languages) > 1) {
                $params['lang'] = $this->currentLang->getLangCode();
            }
        }

        return parent::createUrl($route, $params, $ampersand);
    }
}