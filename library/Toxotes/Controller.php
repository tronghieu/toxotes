<?php
namespace Toxotes;

use Flywheel\Config\ConfigHandler;
use Flywheel\Controller\Web;
use Flywheel\Factory;
use Flywheel\Translation\Translator;

abstract class Controller extends Web {
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
            $widget->controllerTemplate = $this->getTemplatePath() .'/Widget/';
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
     * @param bool $absolute
     * @param string $ampersand
     * @return mixed
     */
    public function createUrl($route, $params = array(), $ampersand = '&', $absolute = false) {
        $route = trim($route, '/');
        if ('post/detail' == $route) {
            if (isset($params['id']) && ($post = \Posts::retrieveById($params['id']))) {
                $params['slug'] = $post->getSlug();
            }

        } else if ('category/default' == $route) {
            if (isset($params['id']) && ($term = \Terms::retrieveById($params['id']))) {
                $params['slug'] = $term->getSlug();
            }
        } else if ('events/default' == $route) {
            if (isset($params['id']) && ($term = \Terms::retrieveById($params['id']))) {
                $params['slug'] = $term->getSlug();
            }
        } else if ('events/detail' == $route) {
            if (isset($params['id']) && ($post = \Posts::retrieveById($params['id']))) {
                $params['slug'] = $post->getSlug();
            }
        }

        $params = Plugin::applyFilters('custom_router_param', $route, $params);

        if ($this->currentLang && sizeof($this->languages) > 1) {
            $params['lang'] = $this->currentLang->getLangCode();
        }

        return parent::createUrl($route, $params, $ampersand, $absolute);
    }

    protected function _initLanguages()
    {
        $this->languages = \Languages::findByPublished(true);
        if (sizeof($this->languages) < 2) {
            $this->currentLang = $this->languages[0];
            return;
        }

        $currentLangCode = $this->request()->get('lang');
        if (!$currentLangCode) {
            $currentLangCode = Factory::getCookie()->read('lang');
        }

        if (!$currentLangCode) {
            $this->currentLang = \Languages::findOneByDefault(true);
            $currentLangCode = $this->currentLang->getLangCode();
        }

        Factory::getCookie()->write('lang', $currentLangCode);

        if (Factory::getRouter()->getUrl() == '/' && !$this->request()->get('lang')) {
            $this->redirect($currentLangCode);
        }

        if (!$this->currentLang) {
            $this->currentLang = \Languages::findOneByLangCode($currentLangCode);
        }

        $translator = Translator::getInstance();
        $translator->setLocale($currentLangCode);

        Cms::$currentLang = $this->currentLang;
    }

    /**
     * Make lang url
     * @param $langCode
     * @return string
     */
    public function makeLangUrl($langCode) {
        return $this->document()->getBaseUrl().$langCode;
    }
}