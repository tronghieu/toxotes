<?php

use Flywheel\Factory;
use Flywheel\Loader;
use Toxotes\Plugin;
Loader::import('app.include.Tables.*');
class PostController extends AdminBaseController {
    public function executeDefault() {
        $taxonomy = $this->request()->get('taxonomy', 'STRING', 'POST');
        $page_title = Plugin::getTaxonomyOption($taxonomy, 'POST', 'label', t('Post Management'));

        $this->document()->title .= $page_title;
        $filter = $this->request()->get('filter', 'ARRAY', array());

        $query = Posts::read();
        if (isset($filter['keyword']) && !empty($filter['keyword'])) {
            $query->andWhere('`title` LIKE "%' .$filter['keyword'] .'%"');
        }

        if (isset($filter['status'])) {
            $query->andWhere('`status` = "' .$filter['status'] .'"');
        }

        if (isset($filter['language'])) {
            $query->andWhere('`language` = "' .$filter['language'] .'"');
        }

        if (isset($filter['cat_id']) && $filter['cat_id'] != 0) {
            $cat = Terms::retrieveById($filter['cat_id']);
            $_c = array();
            if ($cat) {
                $branches = $cat->getBranch();
                foreach ($branches as $branch) {
                    $_c[] = $branch->getId();
                }
                $query->andWhere('`term_id` IN (' .implode(',', $_c) .')');
            }
        }

        //paging
        $page = $this->request()->get('page', 'INIT', 1);
        $query->setMaxResults(20)
            ->setFirstResult(($page-1)*20);

        $list = $query->execute()
            ->fetchAll(\PDO::FETCH_CLASS, 'Posts', array(null, false));

        $total = $query->count()->execute();

        $taxonomy_term = Plugin::getTaxonomyOption($taxonomy, 'POST', 'term_taxonomy', 'category');

        $table = new PostListTable($taxonomy);
        $table->setItems($list);

        $this->view()->assign(array(
            'page_title' => $page_title,
            'taxonomy' => $taxonomy,
            'taxonomy_term' => $taxonomy_term,
            'table' => $table,
            'list' => $list,
            'filter' => $filter,
            'total' => $total
        ));

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