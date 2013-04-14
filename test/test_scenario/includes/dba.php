<?php
class SimpleDBA extends \PDO {
    /**
     * @return SimpleDBA
     */
    public static function getInstance() {
        static $instance;
        if ($instance == null) {
            $instance = new self('mysql:host=192.168.50.62;dbname=mc_billing', 'root', 'abc@123');
        }

        return $instance;
    }
}