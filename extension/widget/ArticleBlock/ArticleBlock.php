<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 2/3/15
 * Time: 5:55 AM
 */

class ArticleBlock extends \Toxotes\Widget {
    public function begin() {
        $post_id = $this->getParams('post_id');
        if ($post_id) {
            $this->post = \Posts::retrieveById($post_id);
        }
    }

    public function html() {
        $this->begin();
        $this->fetchViewPath();
        $this->fetchViewFile();

        $this->params['widget'] = $this;

        return $this->render($this->params);
    }
}