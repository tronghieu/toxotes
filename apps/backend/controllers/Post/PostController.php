<?php

use Flywheel\Factory;
use Toxotes\Plugin;

class PostController extends AdminBaseController {
    public function executeDefault() {
        $type = $this->request()->get('type', 'STRING', 'post');
        $this->dispatch('onBeginListingItem', new AdminEvent($this));

        $this->dispatch('onAfterListingItem', new AdminEvent($this));

        return $this->renderComponent();
    }

    public function executeCreate() {
        $taxonomy = $this->request()->get('taxonomy', 'STRING', 'post');
        $post = new Posts();
        $post->setIsDraft(true);
        $post->setTaxonomy($taxonomy);
        $post->save(false); //save Draft before
        $this->setView('form');

        $error = array();
        if ($this->request()->isPostRequest()) {
            if ($this->_save($post, $error)) {
                Factory::getSession()->setFlash('post_message', t($post->getTitle() .'  was saved!'));
                $this->redirect($this->createUrl('post/default', array('taxonomy' => $taxonomy)));
            }
        }

        $this->view()->assign(array(
            'post' => $post,
            'taxonomy' => $taxonomy,
            'error' => $error,
            'page_title' => t('New post')
        ));

        return $this->renderComponent();
    }

    public function executeEdit() {
        $post = Posts::retrieveById($this->request()->get('id'));
        $taxonomy = $this->request()->get('taxonomy');
        if (null == $taxonomy) {
            $taxonomy = $post->getTaxonomy();
        }

        if (!$post) {
            Factory::getSession()->setFlash('post_error', t('Post not found'));
            $this->redirect($this->createUrl('post/default', array('taxonomy' => $taxonomy)));
        }

        $error = array();
        if ($this->request()->isPostRequest()) {
            if ($this->_save($post, $error)) {
                Factory::getSession()->setFlash('post_message', t($post->getTitle() .' was saved'));
                $this->redirect($this->createUrl('post/default', array('taxonomy'=>$taxonomy)));
            }
        }

        $this->setView('form');
        $this->view()->assign(array(
            'post' => $post,
            'taxonomy' => $taxonomy,
            'error' => $error,
            'page_title' => t('Edit ' .$post->getTitle())
        ));

        return $this->renderComponent();
    }

    public function executeLoadCustomFieldFrm() {
        $category_id = $this->request()->post('category_id');

        $category = Terms::retrieveById($category_id);
        if (!$category) {
            //error
            return $this->renderText('');
        }

        $post_id = $this->request()->post('post_id');

        //load category custom fields
        $categoryCfs = TermCustomFields::findByTermId($category_id);
        if (empty($categoryCfs)) {
            return $this->renderText('');
        }

        /** @var PostCustomFields[] $postCfs */
        $postCfs = array();

        //load item custom field value if exist
        if ($post_id) {
            $_postCfs = PostCustomFields::findByItemId($post_id);
            for ($i = 0, $size = sizeof($_postCfs); $i < $size; ++$i) {
                $postCfs[$_postCfs[$i]->getCfId()] = $_postCfs;
            }

            unset($_postCfs);
        }
        //end load item custom field value

        $data = array();
        foreach ($categoryCfs as $catCf) {
            $d = (object) $catCf->toArray();
            $d->value = '';

            if (isset($postCfs[$catCf->getId()])) {//exist items
                $i = $postCfs[$catCf->getId()];
                switch($catCf->getFormat()) {
                    case 'NUMBER':
                        $d->value = (float) $i->getNumberValue();
                        break;
                    case 'BOOL':
                        $d->value = (bool) $i->getBoolValue();
                        break;
                    case 'DATETIME':
                        $d->value = $i->getDatetimeValue();
                        break;
                    default:
                        $d->value = $i->getTextValue();
                }
            }

            $data[] = $d;
        }

        $data = Plugin::applyFilters('custom_' .$category->getTaxonomy() .'_cf_form_data', $data);

        $buf = $this->renderPartial(array(
            'data' => $data
        ));

        $buf = Plugin::applyFilters('custom_' .$category->getTaxonomy() .'_cf_form', $buf);

        return $buf;
    }

    protected function _save(Posts &$post, &$error) {
        $input = $this->request()->post('post', 'ARRAY', array());
        $post->hydrate($input);
        $post->setIsDraft(false);

        if ($post->getAuthor()) {
            $post->setAuthor($this->getSessionUser()->getName());
        }

        if ($post->save()) {
            return true;
        } else {
            foreach($post->getValidationFailures() as $validationFailure) {
                $error[$validationFailure->getColumn()] = $validationFailure->getMessage();
            }
        }
        return false;
    }
}