<?php

class SlideShow extends \Toxotes\Widget {
    /**
     * @var Banner[]
     */
    public $banners = array();

    public function begin() {
        $groupId = $this->getParams('banner_group_id');
        if ($groupId) {
            $this->banners =  Banner::read()->where('`status`=:status AND `term_id`=:term_id')
                ->setParameters(array(':status' => 'ACTIVE', ':term_id' => $groupId))
                ->orderBy('ordering')
                ->execute()
                ->fetchAll(\PDO::FETCH_CLASS, 'Banner', array(null, false));
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