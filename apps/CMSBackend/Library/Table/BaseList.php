<?php
namespace CMSBackend\Library\Table;


class BaseList {
    public $columns = array();
    public $items = array();
    public $tableHtmlOptions = array();
    public $taxonomy;

    public function __construct($taxonomy) {
        $this->taxonomy = $taxonomy;
    }

    public function init() {}

    public function setItems($items) {
        $this->items = $items;
    }
} 