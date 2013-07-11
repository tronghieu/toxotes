<?php
use Toxotes\Plugin;

abstract class AdminBaseController extends \Flywheel\Controller\WebController {
    public function beforeExecute() {
        parent::beforeExecute();
        $this->_registerDefaultTaxonomies();
        $this->loadPlugin();
        if($this->getName() != 'Auth' && !BackendAuth::getInstance()->isAuthenticated()) {
            $this->redirect(
                $this->createUrl('auth/login', array(
                    'r' => urlencode(\Flywheel\Factory::getRouter()->getUrl()))));
        }

        Plugin::doAction('before_execute');
    }

    public function loadPlugin() {
        /** @var Extension[] $extensions */
        $extensions = \Extension::findByStatus(1);
        foreach($extensions as $extension) {
            $basePath = ROOT_PATH .'/extension/' .(($extension->type == 'PLUGIN')? 'plugin/' : 'module/');
            require_once $basePath .$extension->path;
        }
    }

    protected function _beforeRender() {
        $this->view()->assign('controller', $this);
        parent::_beforeRender();
    }

    /**
     * get current login user
     * return Users
     */
    public function getSessionUser() {
        return BackendAuth::getInstance()->getUser();
    }

    protected function _registerDefaultTaxonomies() {
        Plugin::registerTaxonomy('category', 'post', array(
            'label' => t('Category'),
            'enable_custom_fields' => true,
        ));

        Plugin::registerTaxonomy('banner', 'post', array(
            'label' => t('Banner'),
            'enable_custom_fields' => false,
        ));

        Plugin::registerTaxonomy('post', 'post', array(
            'label' => t('Post')
        ));
    }
}
