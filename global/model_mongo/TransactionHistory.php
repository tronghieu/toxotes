<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 3/15/13
 * Time: 2:38 PM
 * To change this template use File | Settings | File Templates.
 */

class TransactionHistory {

    public $acc_uk;
    public $trans_code;
    public $amount = 0;
    public $acc_balance = 0;
    public $acc_frozen_balance = 0;
    public $acc_version = 1;
    public $relate_trans;
    public $mess = '';
    public $sys_mess = '';
    public $time;

    public $collectionName = 'transaction_history';

    public $dbName = 'core_billing';

    private $_conn;

    public function __construct($isNew = false) {
        $this->init();
    }

    public function init() {
        $this->time = new MongoDate();
    }

    public function toArray() {
        $data = get_object_vars($this);
        unset($data['collectionName']);
        unset($data['dbName']);
        unset($data['_conn']);
        return $data;
    }

    public function save() {
        try {
            $this->getConnection()->{$this->dbName}->{$this->collectionName}->insert($this->toArray());
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     *
     */
    public function getConnection() {
        if (null == $this->_conn) {
            $config = \Flywheel\Config\ConfigHandler::load('global.config.mongodb', 'mongodb', true);

            if (!class_exists('Mongo') && !class_exists('MongoClient')) {
                throw new \InvalidArgumentException('MongoClient or Mongo instance required');
            }
            $options = $config['options'];
            $dsn = $config['dsn'];

            try {
                if (class_exists('Mongo')) {
                    $this->_conn = new \Mongo($dsn, $options);
                } else if (class_exists('MongoClient')) {
                    $this->_conn = new \MongoClient($dsn, $options);
                }
            } catch (MongoConnectionException $e) {
                throw $e;
            }
        }
        return $this->_conn;
    }
}