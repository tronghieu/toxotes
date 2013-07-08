<?php
use Toxotes\Plugin;

class PostListTable extends ListTable {
    public function __construct($taxonomy) {
        parent::__construct($taxonomy);
        $this->tableHtmlOptions['class'] = 'table '.@$this->tableHtmlOptions['class'];
        $this->init();
    }

    public function init() {
        parent::init();
        $this->columns = array(
            'cb',
            'name' => array(
                'label' => t('Title'),
            ),
            'status' => array(
                'label' => t('Status'),
                'value' => '$item->getStatus();'
            ),
            'category' => array(
                'label' => t('Category'),
            ),
            'ordering' => array(
                'label' => t('Ordering'),
                'value' => '$item->getOrdering();'
            ),
            'language' => array(
                'label' => t('Language'),
                'value' => '$item->getLanguage();'
            ),
            'id' => array(
                'label' => 'Id',
                'value' => '$item->getId();'
            ),
        );

        $this->columns = Plugin::applyFilters(
            'init_' .$this->taxonomy.'_post_columns',
            $this->columns
        );
    }

    public function render() {
        $html = '';
        return $html;
    }

    public function display() {
        echo $this->render();
    }
}