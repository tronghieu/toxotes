<?php
namespace CMSBackend\Controller;


use CMSBackend\Event\CMSBackendEvent;
use CMSBackend\Library\Table\TermList;
use Flywheel\Base;
use Flywheel\Html\Form\Checkbox;
use Flywheel\Html\Form\Input;
use Flywheel\Html\Form\RadioButton;
use Flywheel\Html\Form\SelectOption;
use Flywheel\Html\Form\TextArea;
use Flywheel\Session\Session;
use Toxotes\Content;
use Toxotes\Plugin;

class Category extends CMSBackendBase {
    public $event;

    public function executeDefault()
    {
        $this->setView('Category/default');
        $taxonomy = $this->get('taxonomy', 'STRING', 'category');
        if ($taxonomy == 'category') {
            $this->view()->assign('page_title', 'Category');
        } else {
            $this->view()->assign('page_title', Plugin::applyFilters('custom_'.$taxonomy.'_page_title'));
        }

        $root = \Terms::retrieveRoot($taxonomy);
        $listTerms = $root->getDescendants();

        $table = new TermList($taxonomy);
        $table->tableHtmlOptions = [
            'class' => 'table table-nomargin table-striped'
        ];
        $table->setItems($listTerms);

        $this->view()->assign([
            'table' => $table,
            'taxonomy' => $taxonomy,
            'listTerms' => $listTerms,
        ]);

        return $this->renderComponent();
    }

    public function executeCreate() {
        $this->setView('Category/form');
        $inputTerm = new \stdClass();
        $taxonomy = $this->request()->get('taxonomy', 'STRING', 'category');
        $error = array();

        $term = new \Terms();

        if ($taxonomy == 'category') {
            $this->view()->assign('page_title', t('Add Category'));
        } else {
            $this->view()->assign('page_title', Plugin::applyFilters('custom_'.$taxonomy.'_create_page_title'));
        }

        $parent = $this->request()->post('term_parent', 'INT', 0);
        if (0 == $parent) {
            if ($term->getLevelValue() > 1) {
                $parent = $term->getParent()->getId();
            }
        }

        if ($this->request()->isPostRequest()) {//submit new Term
            //assign $inputTerm value
            $inputs = $this->request()->post('term', 'ARRAY', array());
            foreach ($inputs as $input=>$value) {
                $inputTerm->$input = $value;
            }

            $inputTerm = Plugin::applyFilters('handling_' .$taxonomy.'_term_form_input', $inputTerm);

            if ($this->_save($term, $error)) {
                $session = Session::getInstance();
                $session->setFlash('term',
                    [
                        'type' => 'SUCCESS',
                        'message' => t('Save successful!')
                    ]);

                $this->redirect($this->createUrl('category/default', array('taxonomy' => $taxonomy)));
            }
        }

        $this->dispatch('onBeforeEditTerm', new CMSBackendEvent($this, [
            'term' => $term
        ]));

        $proControl = $this->_propertyForm($term, $taxonomy);
        $this->view()->assign(array(
            'term' => $term,
            'inputTerm' => $inputTerm,
            'taxonomy' => $taxonomy,
            'parent' => $parent,
            'error' => $error,
            'propertiesControl' => $proControl,
        ));

        return $this->renderComponent();
    }

    public function executeEdit() {
        $this->setView('Category/form');
        $term = \Terms::retrieveById($this->get('id'));
        $session = Session::getInstance();
        $error = [];

        if (!$term) {//not found
            $session->setFlash('term', [
                'type' => 'ERROR',
                'message' => t('Term not found with' .$this->get('id'))
            ]);
            $this->redirect($this->createUrl('category', array('taxonomy' => $this->get('taxonomy'))));
        }

        $taxonomy = $term->getTaxonomy();

        $error = array();

        $inputTerm = (object) $term->toArray();

        $parent = $this->request()->post('term_parent', 'INT', 0);
        if (0 == $parent) {
            if ($term->getLevelValue() > 1) {
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
                $session->setFlash('term', [
                    'type' => 'SUCCESS',
                    'message' => t('Save successful!')
                ]);
                $this->redirect($this->createUrl('category/default', array('taxonomy' => $taxonomy)));
            }
        }

        $this->dispatch('onBeforeEditTerm', new CMSBackendEvent($this, [
            'term' => $term
        ]));

        $proControl = $this->_propertyForm($term, $taxonomy);
        $this->view()->assign(array(
            'page_title' => 'Sửa '.$term->getName(),
            'term' => $term,
            'inputTerm' => $inputTerm,
            'taxonomy' => $taxonomy,
            'parent' => $parent,
            'error' => $error,
            'propertiesControl' => $proControl,
        ));

        return $this->renderComponent();
    }

    private function _propertyForm(\Terms $term, $taxonomy) {
        Plugin::applyFilters('term_property_form_' .$taxonomy);

        $controls = [];
        $propertiesOpt = Content::getTermPropertiesOpt($taxonomy);
        //form control
        foreach($propertiesOpt as $key => $setting) {
            if (!$term->isNew()) {
                $setting['value'] = \TermProperty::getTermPropertyValue($term->getId(), $key);
            } else {
                $setting['value'] = '';
            }

            $name = "term_prop[{$key}]";
            $html_options = $setting;
            unset($html_options['label']);
            unset($html_options['value']);
            unset($html_options['control']);
            unset($html_options['options']);

            $controls[$key] = [
                'label' => isset($setting['label'])? $setting['label'] : '',
            ];

            switch($setting['control']) {
                case 'input':
                    $object = new Input($name, $setting['value'], $html_options);
                    $object->setType($setting['type']);
                    unset($html_options['type']);
                    $controls[$key]['controlObject'] = $object;
                    break;
                case 'textarea':
                    $controls[$key]['controlObject'] = new TextArea($name, $setting['value'], $html_options);
                    break;
                case 'select' :
                    $object = new SelectOption($name, $setting['value'], $html_options);
                    foreach(@$setting['options'] as $opt) {
                        $object->addOption($opt['label'], $opt['value'], @$opt['htmlOption']);
                    }
                    $controls[$key]['controlObject'] = $object;
                    break;
                case 'checkbox' :
                    $object = new Checkbox($name, $setting['value'], $html_options);
                    $object->setExpectValue($setting['default']);
                    $controls[$key]['controlObject'] = $object;
                    break;
                case 'radio':
                    unset($html_options['options']);
                    $object = new RadioButton($name, $setting['value']);
                    foreach(@$setting['options'] as $opt) {
                        $object->add($opt['value'], $opt['label'], @$opt['htmlOption'], @$opt['inputOption']);
                    }
                    $controls[$key]['controlObject'] = $object;
                    break;
            }
        }

        return $controls;
    }

    /**
     * Save term
     *
     * @param \Terms $term
     * @param $error
     * @return bool
     */
    public function _save(\Terms $term, &$error) {
        $current_status = $term->getStatus();
        $term->hydrate($this->post('term', 'ARRAY', array()));
        $parentId = $this->post('term_parent', 'INT', 0);
        if ($parentId == 0) {
            $parent = \Terms::retrieveRoot($term->taxonomy);
        } else {
            $parent = \Terms::retrieveById($parentId);
            if (!$parent) {
                $error['parent'] = array(
                    t('Term parent not found with id:' .$parentId)
                );
                return false;
            }
        }

        $is_new = $term->isNew();

        $term->beginTransaction();
        try {
            if ($is_new) { // create new
                $term->setParentId($parent->getId());
                $term->setStatus($parent->getStatus());
                $term->insertAsLastChildOf($parent);
                //dispatch event create new
                $this->dispatch('onCreateNewCatalog', new CMSBackendEvent($this, [
                    'term' => $term
                ]));
                $this->_saveProperty($term, $error);
            } else { // save information
                $currentParent = $term->getParent();
                if ($parent->getId() == $term->getId()) {//something fucked
                    $error['parent'] = t('Could not move to child of itself!');
                }

                if ($currentParent->getId() != $parent->getId()) {//moved category
                    $term->moveToLastChildOf($parent);
                    $term->setParentId($parent->getId());
                    $term->setStatus($parent->getStatus());
                    $this->_saveProperty($term, $error);

                    if (!$term->save()) {//save information first
                        $this->dispatch('onUpdateTerm', new CMSBackendEvent($this, [
                            'term' => $term
                        ]));
                        if (!$term->isValid()) {
                            $failures = $term->getValidationFailures();
                            foreach($failures as $failure) {
                                $error[$failure->getColumn()] = $failure->getMessage();
                            }
                        }
                    }
                } else {//simply save information
                    if ($term->save()) {
                        $this->_saveProperty($term, $error);
                        //dispatch event update
                        $this->dispatch('onUpdateTerm', new CMSBackendEvent($this, [
                            'term' => $term
                        ]));
                    } else if (!$term->isValid()) {
                        $failures = $term->getValidationFailures();
                        foreach($failures as $failure) {
                            $error[$failure->getColumn()] = $failure->getMessage();
                        }
                    }

                    if (!empty($error)) {
                        $term->rollBack();
                        return false;
                    }
                } //end simply save information

                if ($current_status != $term->getStatus()
                    && $term->getStatus() == \Terms::STATUS_INACTIVE) {//change status to INACTIVE
                    $term->changeDescendantsStatus(\Terms::STATUS_INACTIVE);
                }
            }

            if ($term->isValid()) {
                $term->commit();
                return $term;
            }
            $term->rollBack();
        } catch (\Exception $e) {
            $term->rollBack();
            throw new $e;
        }

        $failures = $term->getValidationFailures();
        foreach($failures as $failure) {
            $error[$failure->getColumn()] = $failure->getMessage();
        }

        return false;
    }

    /**
     * @param \Terms $term
     * @param $error
     */
    protected function _saveProperty(\Terms &$term, &$error) {
        $properties = $this->request()->post('term_prop', 'ARRAY', array());
        foreach($properties as $key => $value) {
            $obj = \TermProperty::getPropertyObj($term->getId(), $key);
            if (!$obj) {
                $obj = new \TermProperty();
                $obj->setTermId($term->getId());
                $obj->setPropertyKey($key);
            }
            $obj->setPropertyValue($value);
            $obj->save();
        }
    }

    public function executeDelete() {
        if (!$this->validAjaxRequest() || !$this->request()->isPostRequest()) {
            Base::end('Invalid Request');
        }

        $term = \Terms::retrieveById($this->request()->get('id'));
        $session = Session::getInstance();
        $ajax = new \AjaxResponse();
        if (!$term) {//not found
            $ajax->type = \AjaxResponse::ERROR;
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
                $ajax->type = \AjaxResponse::SUCCESS;
            } else {
                $ajax->message = t('An error occurred, ' .$term->getName() .' can not be deleted');
                $ajax->type = \AjaxResponse::ERROR;
            }
        } else {
            $ajax->message = implode('. ', $error);
            $ajax->type = \AjaxResponse::ERROR;
        }

        return $this->renderText($ajax->toString());
    }

    public function executeCustomField() {
        $term = \Terms::retrieveById($this->request()->get('id'));
        $this->setView('custom_fields');
        $session = Session::getInstance();

        if (!$term) {
            $session->setFlash('term_message', t('Term not found with' .$this->request()->get('id')));
            $this->redirect($this->createUrl('category', array('taxonomy' => $this->request()->get('taxonomy'))));
        }

        $error = array();
        $message = array();

        $input = new \TermCustomFields();
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

        $customFields = \TermCustomFields::findByTermId($term->getId());
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

        $ajax = new \AjaxResponse();

        $customField = \TermCustomFields::retrieveById($this->request()->get('id'));
        if (!$customField) {
            $ajax->message = t("Custom field not found!");
            $ajax->type = \AjaxResponse::ERROR;
            return $this->renderText($ajax->toString());
        }

        $customField->beginTransaction();
        if ($customField->delete()) {
            \PostCustomFields::write()
                ->delete(\PostCustomFields::getTableName())
                ->where('cf_id = ?')
                ->setParameter(1, $customField->getId(), \PDO::PARAM_INT)
                ->execute();

            $customField->commit();
            $ajax->message = t($customField->getName() .' was removed!');
            $ajax->type = \AjaxResponse::SUCCESS;
            return $this->renderText($ajax->toString());
        }

        $customField->rollBack();
        $ajax->message = t("Could not remove {$customField->getName()}!");
        $ajax->type = \AjaxResponse::ERROR;
        return $this->renderText($ajax->toString());
    }

    public function executeEditCf() {
        $session = Session::getInstance();
        $cf = \TermCustomFields::retrieveById($this->request()->get('id'));
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