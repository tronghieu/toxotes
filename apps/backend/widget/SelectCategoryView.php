<?php

use Flywheel\Html\Form;

class SelectCategoryView extends AdminBaseWidget {
    /**
     * @var Form
     */
    public $form;

    public $files = array();

    public function begin() {
        $this->selected = null;
        if ($this->cat_id) {
            $term = Terms::retrieveById($this->cat_id);
            $catViewProperty = $term->getProperty('cat_view');
            if ($catViewProperty) {
                $this->selected = $catViewProperty->getValue();
            }
        }

        $config = require(FRONTEND_DIR .'/config/main.cfg.php');
        $template = isset($config['template'])? $config['template'] : 'default';
        $templateDir = FRONTEND_DIR .'/templates/' .$template.'/controllers/Category/';
        $finder = new \Flywheel\Finder\Finder();
        $finder->files()->name('*.phtml')->in($templateDir);
        foreach($finder as $file) {
            $this->files[] = str_replace('.phtml', '', $file->getFilename());
        }
    }

    public function end() {
        $select = $this->form->selectOption('property[cat_view]', $this->selected);
        foreach ($this->files as $file) {
            $select->addOption($file, $file);
        }
        $select->display();
    }
}