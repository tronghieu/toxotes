<?php
class PostController extends FrontendBaseController {
    public function executeDefault() {
        return $this->executeDetail();
    }

    public function executeDetail() {
        if(!($post = Posts::retrieveById($this->request()->get('id')))) {
            $this->raise404();
        }

        $post->setHits($post->getHits() + 1);
        $post->save(false);

        $term = Terms::retrieveById($post->getTermId());
        if (($viewProp = $term->getProperty('post_view'))
            && $this->view()->checkViewFileExist($this->getTemplatePath() .'/controllers/'.$this->_path .$viewProp->getValue())) {
            $this->setView($viewProp->getValue());
        }

        $this->view()->assign(array(
            'post' => $post,
            'term' => $term
        ));

        return $this->renderComponent();
    }
}