<?php
namespace FlyApi;


abstract class Consumer {
    public $key;
    public $secret;

    function __construct($key, $secret) {
        $this->key = $key;
        $this->secret = $secret;
    }

    function __toString() {
        return json_encode($this);
    }
}