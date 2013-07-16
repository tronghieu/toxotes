<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 5/25/13
 * Time: 6:35 PM
 * To change this template use File | Settings | File Templates.
 */

use Flywheel\Base;
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
            $this->_saveProperty($term, $error);
        } else {
            $currentParent = $term->getParent();
            if ($parent->id == $term->getId()) {
                $error['parent'] = array(t('Could not make child of itself'));
                return false;
            }

            if ($currentParent->id != $parent->id) {//change parent
                $term->moveToLastChildOf($parent);
                $this->_saveProperty($term, $error);
            } else {//save normal
                if($term->save()) {// only save information
                    $this->_saveProperty($term, $error);
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

    protected function _saveProperty(\Terms &$term, &$error) {
        $properties = $this->request()->post('property', 'ARRAY', array());

        if ($term->taxonomy == 'category') {
            if (isset($properties['cat_view']) && $properties['cat_view']) {
                $catViewProp = $term->getProperty('cat_view');
                if (!$catViewProp) {
                    $catViewProp = new TermProperty();
                }
                $catViewProp->setProperty('cat_view');
                $catViewProp->setTermId($term->getId());
                $catViewProp->setTextValue($properties['cat_view']);
                $catViewProp->setValueType(TermProperty::TEXT);
                $catViewProp->save();
            }

            if (isset($properties['post_view']) && $properties['post_view']) {
                $postViewProp = $term->getProperty('post_view');
                if (!$postViewProp) {
                    $postViewProp = new TermProperty();
                }
                $postViewProp->setProperty('post_view');
                $postViewProp->setTermId($term->getId());
                $postViewProp->setTextValue($properties['post_view']);
                $postViewProp->setValueType(TermProperty::TEXT);
                $postViewProp->save();
            }
        }
    }

    public function executeDelete() {
        if (!$this->validAjaxRequest() || !$this->request()->isPostRequest()) {
            Base::end('Invalid Request');
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

        if ($term->hasPosts()) {//check has posts
            $error[] = t($term->getName() .' has posts, can not be deleted');
        }

        if (empty($error)) {
            $term->delete();
            if ($term->delete()) {
                $ajax->term = $term->toArray();
                $ajax->id = $term->getId();
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

    public function executeCustomField() {
        $term = Terms::retrieveById($this->request()->get('id'));
        $this->setView('custom_fields');
        $session = Factory::getSession();

        if (!$term) {
            $session->setFlash('term_message', t('Term not found with' .$this->request()->get('id')));
            $this->redirect($this->createUrl('category', array('taxonomy' => $this->request()->get('taxonomy'))));
        }

        $error = array();
        $message = array();

        $input = new TermCustomFields();
        if ($this->request()->isPostRequest()) {
            $input->hydrate($this->request()->post('custom_fields'));
            $input->setTermId($term->getId());

            if (!($acceptValues = $this->request()->post('accept_values'))) {
                $acceptValues = explode("\n", $acceptValues);
                $input->setAcceptValue(json_encode($acceptValues));
            }

            if ($input->save()) {
                $message = t('Save new custom fields success!');
            } else {
                if (!$input->isValid()) {
                    foreach($input->getValidationFailures() as $validationFailures) {
                        $error[$validationFailures->getColumn()] = $validationFailures->getMessage();
                    }
                }
            }
        }

        $customFields = TermCustomFields::findByTermId($term->getId());
        $this->setView('custom_fields');
        $this->view()->assign(array(
            'error' => $error,
            'message' => $message,
            'term' => $term,
            'input' => $input,
            'custom_fields' => $customFields
        ));

        return $this->renderComponent();
    }

    public function executeRemoveCf() {
        if ($this->validAjaxRequest() || !$this->request()->isPostRequest()) {
            Base::end('Invalid request!');
        }

        $ajax = new AjaxResponse();

        $customField = TermCustomFields::retrieveById($this->request()->get('id'));
        if (!$customField) {
            $ajax->message = t("Custom field not found!");
            $ajax->type = AjaxResponse::ERROR;
            return $this->renderText($ajax->toString());
        }

        $customField->beginTransaction();
        if ($customField->delete()) {
            PostCustomFields::write()
                ->delete(PostCustomFields::getTableName())
                ->where('cf_id = ?')
                ->setParameter(1, $customField->getId(), \PDO::PARAM_INT)
                ->execute();

            $customField->commit();
            $ajax->message = t($customField->getName() .' was removed!');
            $ajax->type = AjaxResponse::SUCCESS;
            return $this->renderText($ajax->toString());
        }

        $customField->rollBack();
        $ajax->message = t("Could not remove {$customField->getName()}!");
        $ajax->type = AjaxResponse::ERROR;
        return $this->renderText($ajax->toString());
    }

    public function executeEditCf() {
        $session = Factory::getSession();
        $cf = TermCustomFields::retrieveById($this->request()->get('id'));
        $term_id = $this->request()->get('term_id');
        if (!$cf) {
            $session->setFlash('cf_error', t('Custom field not found'));
            $this->redirect($this->createUrl('category/custom_field', array('id' => $term_id)));
        }

        $error = array();

        if ($this->request()->isPostRequest()) {
            $cf->hydrate($this->request()->post('custom_fields', 'ARRAY', array()));
            $acceptValues = explode("\n", $this->request()->post('accept_values'));
            $cf->setAcceptValue(json_encode($acceptValues));

            if ($cf->save()) {
            }
        }

        $formData = (object) $cf->toArray();
        $formData['accept_values'] = implode("\n", json_decode($formData['accept_values']));
        $this->setView('cf_form');
        $this->view()->assign(array(
            'data' => $formData,
            'custom_fields' => $cf
        ));
    }
}