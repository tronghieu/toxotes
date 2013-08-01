<?php

class SelectPostView extends AdminBaseWidget {
    /**
     * @var Form
     */
    public $form;

    public $files = array();

    public function begin() {
        $this->selected = null;
        if ($this->cat_id) {
            $term = Terms::retrieveById($this->cat_id);
            $viewProperty = $term->getProperty('post_view');
            if ($viewProperty) {
                $this->selected = $viewProperty->getValue();
            }
        }

        $config = require(FRONTEND_DIR .'/config/main.cfg.php');
        $template = isset($config['template'])? $config['template'] : 'default';
        $templateDir = FRONTEND_DIR .'/templates/' .$template.'/controllers/Post/';
        $finder = new \Flywheel\Finder\Finder();
        $finder->files()->name('*.phtml')->in($templateDir);
        foreach($finder as $file) {
            $this->files[] = str_replace('.phtml', '', $file->getFilename());
        }
    }

    public function end() {
        $select = $this->form->selectOption('property[post_view]', $this->selected);
        foreach ($this->files as $file) {
            $select->addOption($file, $file);
        }
        $select->display();
    }
}