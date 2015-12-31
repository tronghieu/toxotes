<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 2/3/15
 * Time: 11:12 AM
 */

namespace Frontend\Controller;


class Post extends FrontendBase {
    public function executeDefault() {
        return $this->executeDetail();
    }

    public function executeDetail() {
        if(!($post = \Posts::retrieveById($this->request()->get('id')))) {
            $this->raise404();
        }

        $post->setHits($post->getHits() + 1);
        $post->save(false);

        $term = \Terms::retrieveById($post->getTermId());
        if (($viewProp = $term->getProperty('post_view'))
            && $this->view()->checkViewFileExist($this->getTemplatePath() .'/Controller/Post/'.$this->_path .$viewProp->getPropertyValue())) {
            $this->setView('Post/' .$viewProp->getPropertyValue());
        } else {
            $this->setView('Post/default');
        }

        $this->view()->assign(array(
            'post' => $post,
            'term' => $term
        ));

        return $this->renderComponent();
    }
}