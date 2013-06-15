<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 5/25/13
 * Time: 6:35 PM
 * To change this template use File | Settings | File Templates.
 */

use Flywheel\Factory;
use Flywheel\Loader;
use Toxotes\Plugin;

Loader::import('app.include.Tables.*');

class CategoryController extends AdminBaseController {
    public $event;
    public function executeDefault() {
        $inputTerm = new stdClass();
        $taxonomy = $this->request()->get('taxonomy', 'STRING', 'category');
        $error = array();
        $message = '';

        $session = Factory::getSession();
        $message = $session->getFlash('term_message');

        if ($this->request()->isPostRequest()) {//submit new Term
            //assign $inputTerm value
            $inputs = $this->request()->post('term', 'ARRAY', array());
            foreach ($inputs as $input=>$value) {
                $inputTerm->$input = $value;
            }

            $inputTerm = Plugin::applyFilters('handling_' .$taxonomy.'_term_form_input', $inputTerm);

            $term = new Terms();
            if ($this->_save($term, $error)) {
                $message = t('Save successful!');
                $inputTerm = new stdClass(); //reset form
            } else {
                $message = t('Saving fail!');
            }
        }


        $event = new AdminEvent($this);
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
        $listTerms = $root->getDescendants($query);

        $table = new TermListTable($taxonomy);
        $table->setItems($listTerms);

        $this->view()->assign(array(
            'table' => $table,
            'keyword' => $keyword,
            'taxonomy' => $taxonomy,
            'listTerms' => $listTerms,
            'inputTerm' => $inputTerm,
            'error' => $error,
            'message' => $message
        ));

        return $this->renderComponent();
    }

    public function executeEdit() {
        $term = Terms::retrieveById($this->request()->get('id'));
        $session = Factory::getSession();
        if (!$term) {
            $session->setFlash('term_message', t('Term not found with' .$this->request()->get('id')));
            $this->redirect($this->createUrl('category', array('taxonomy' => $this->request()->get('taxonomy'))));
        }

        $taxonomy = $term->getTaxonomy();

        $this->setView('form');
        $inputTerm = new stdClass();
        $error = array();

        $inputTerm = (object) $term->toArray();

        $parent = $this->request()->post('term_parent', 'INT', 0);
        if (0 == $parent) {
            if ($term->getLevel() > 1) {
                $parent = $term->getParent()->getId();
            }
        }

        if ($this->request()->isPostRequest()) {
            //assign $inputTerm value
            $inputs = $this->request()->post('term', 'ARRAY', array());
            foreach ($inputs as $input=>$value) {
                $inputTerm->$input = $value;
            }

            $inputTerm = Plugin::applyFilters('handling_' .$taxonomy.'_term_form_input', $inputTerm);
            if ($this->_save($term, $error)) {
                $session->setFlash('message', t('Save successful!'));
                $this->redirect($this->createUrl('category/default', array('taxonomy' => $taxonomy)));
            }
        }

        $this->event = new AdminEvent($this, array('term' => $term));
        $this->event = $this->dispatch('onBeforeEditTerm', $this->event);
        $this->view()->assign(array(
            'term' => $term,
            'inputTerm' => $inputTerm,
            'taxonomy' => $taxonomy,
            'parent' => $parent,
            'page_title' => t('Edit ' .$term->getName()),
            'error' => $error
        ));

        return $this->renderComponent();
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
        if ($isNew) {
            $term->insertAsLastChildOf($parent);
        } else {
            $currentParent = $term->getParent();
            if ($currentParent->id != $parent->id) {//change parent
                $term->moveToLastChildOf($parent);
            } else {//save normal
                if($term->save()) {// only save information
                    return true;
                } else {
                    if (!$term->isValid()) {
                        $failures = $term->getValidationFailures();
                        foreach ($failures as $failure) {
                            if (!isset($error[$failure->getColumn()])) {
                                $error[$failure->getColumn()] = array();
                            }
                            $error[$failure->getColumn()][] = $failure->getMessage();
                        }
                        $error = Plugin::applyFilters('after_' .$term->taxonomy .'_save_error', $error);

                        return empty($error);
                    }

                    return false;
                }
            } //end save normal
        }

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

        return empty($error);
    }

    public function executeDelete() {
        if (!$this->validAjaxRequest() || !$this->request()->isPostRequest()) {
            \Flywheel\Base::end('Invalid Request');
        }

        $term = Terms::retrieveById($this->request()->get('id'));
        $session = Factory::getSession();
        $ajax = new AjaxResponse();
        if (!$term) {//not found
            $ajax->type = AjaxResponse::ERROR;
            $ajax->message = t('Term was could not be found');
            return $this->renderText($ajax->toString());
        }

        $error = array();

        if ($term->hasChildren()) { //check has children
            $error[] = t($term->getName() .' has children, can not be deleted');
        }

        if ($term->hasItems()) {//check has items
            $error[] = t($term->getName() .' has items, can not be deleted');
        }

        if (empty($error)) {
            $term->delete();
            if ($term->delete()) {
                $ajax->term = $term;
                $ajax->message = t($term->getName() .' was deleted!');
                $ajax->type = AjaxResponse::SUCCESS;
            } else {
                $ajax->message = t('An error occurred, ' .$term->getName() .' can not be deleted');
                $ajax->type = AjaxResponse::ERROR;
            }
        } else {
            $ajax->message = implode('. ', $error);
            $ajax->type = AjaxResponse::ERROR;
        }

        return $this->renderText($ajax->toString());
    }
}