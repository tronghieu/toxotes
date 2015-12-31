<?php

use Flywheel\Base;
use Flywheel\Document\Html;

class SlideShow extends \Toxotes\Widget {
    /**
     * @var Banner[]
     */
    public $banners = array();

    public function begin() {
        /** @var Html $document */

        $groupId = $this->getParams('banner_group_id');
        if ($groupId) {
            $this->banners =  Banner::select()
                ->where('`status`=:status AND `term_id`=:term_id')
                ->setParameters([
                    ':status' => 'ACTIVE',
                    ':term_id' => $groupId
                ])
                ->orderBy('ordering')
                ->execute();
        }
    }

    public function html() {
        $this->begin();
        $this->fetchViewPath();
        $this->fetchViewFile();

        $html = $this->render(array(
            'widget' => $this
        ));

        return $html;
    }
}