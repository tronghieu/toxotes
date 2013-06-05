<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 6/5/13
 * Time: 10:39 AM
 * To change this template use File | Settings | File Templates.
 */

class TermListTable extends ListTable {
    public function __construct($taxonomy) {
        parent::__construct($taxonomy);
    }

    public function prepareItems() {}

    public function init() {
        parent::init();
        $this->columns = array(
            'cb',
            'name' => array(
                'label' => t('Name'),
            ),
            'description' => array(
                'label' => t('Description')
            )
        );

        $this->columns = \Toxotes\Plugin::applyFilters(
            'init_' .$this->taxonomy.'_term_columns',
            $this->columns
        );

        $this->columns[] = 'tool';
    }

    public function display() {
        echo '<table' .\Flywheel\Html\Html::serializeHtmlOption($this->tableHtmlOptions) .'>';
        echo '<thead>';
            echo $this->displayHeaderRow();
        echo '</thead>';
        echo '<tbody>';
            echo $this->displayRows();
        echo '</tbody>';
        echo '<tfoot>';
            echo $this->displayFootRow();
        echo '</tfoot>';
    }

    public function displayHeaderRow() {}

    public function displayRows() {}
}