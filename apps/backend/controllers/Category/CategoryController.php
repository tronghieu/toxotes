<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 5/25/13
 * Time: 6:35 PM
 * To change this template use File | Settings | File Templates.
 */

use Flywheel\Loader;
use Toxotes\Plugin;

Loader::import('app.include.Tables.*');

class CategoryController extends AdminBaseController {
    public $event;
    public function executeDefault() {
        $event = new AdminEvent($this);

        $taxonomy = $this->request()->get('taxonomy', 'STRING', 'category');
        $keyword = $this->request()->get('keyword');

        $query = Terms::read();

        if (!empty($keyword)) {
            $query->andWhere('`name` LIKE "%' .$keyword .'%"');
        }

        $event->params['query'] = $query;
        $query = $this->dispatch('onAfterParseFilterTerm', $event)->params['query'];

        if ($taxonomy == 'category') {
            $this->view()->assign('page_title', 'Category');
        } else {
            $this->view()->assign('page_title', Plugin::applyFilters('custom_'.$taxonomy.'_page_title'));
        }

        //select
        $root = Terms::retrieveRoot($taxonomy);
        $terms = $root->getDescendants();

        $listTerms = $root->getDescendants($query);

        $inputTerm = new stdClass();
        $error = array();

        if ($this->request()->isPostRequest()) {//submit new Term
            //assign $inputTerm value
            $inputs = $this->request()->post('term', 'ARRAY', array());
            foreach ($inputs as $input=>$value) {
                $inputTerm->$input = $value;
            }

            $inputTerm = Plugin::applyFilters('handling_' .$taxonomy.'_term_form_input', $inputTerm);

            $term = new Terms();
            if ($this->_save($term, $error)) {
                $inputTerm = array();
            }
        }

        foreach($terms as $term) {
            $term->getProperties();
        }

        $table = new TermListTable($taxonomy);
        $table->setItems($terms);

        $this->view()->assign(array(
            'table' => $table,
            'terms' => $terms,
            'keyword' => $keyword,
            'taxonomy' => $taxonomy,
            'listTerms' => $listTerms,
            'inputTerm' => $inputTerm,
            'error' => $error
        ));

        return $this->renderComponent();
    }

    public function executeEdit() {
        $term = Terms::retrieveById($this->request()->get('id'));
        if (!$term) {
            $session = \Flywheel\Factory::getSession();
            $session->setFlash('warning', 'Term not found with' .$this->request()->get('id'));
            $this->redirect($this->createUrl('category', array('type' => $this->request()->get('type'))));
        }

        $this->setView('form');
        $error = array();

        if ($this->request()->isPostRequest()) {
            if ($this->_save($term, $error)) {}
        }

        $this->event = new AdminEvent($this, array('term' => $term));
        $this->event = $this->dispatch('onBeforeEditTerm', $this->event);
    }

    public function _save(Terms $term, &$error) {
        $term->hydrate($this->request()->post('term', 'ARRAY', array()));
        $parentId = $this->request()->post('term_parent', 'INT', 0);
        if ($parentId == 0) {
            $parent = Terms::retrieveRoot($term->taxonomy);
        } else {
            $parent = Terms::retrieveById($parentId);
            if (!$parent) {
                $error['parent'] = array(
                    t('Term parent not found with id:' .$parentId)
                );
                return false;
            }
        }

        $isNew = $term->isNew();
        $term->insertAsLastChildOf($parent);

        if (!$term->isValid()) {
            $failures = $term->getValidationFailures();
            foreach ($failures as $failure) {
                if (!isset($error[$failure->getColumn()])) {
                    $error[$failure->getColumn()] = array();
                }
                $error[$failure->getColumn()][] = $failure->getMessage();
            }
            $error = Plugin::applyFilters('after_' .$term->taxonomy .'_save_error', $error);
        }

        return (sizeof($error) > 0);
    }
}