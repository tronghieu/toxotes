<?php
$host = '192.168.50.62';
$port = 6379;
$auth = '';
return array(
    '__default__' => 'default',
    //config key info
    'default'   => array(
        'servers' => 'server1_0'),
    'consumer'  => array(
        'servers' => 'server1_1'),
    'nonce'     => array(
        'servers' => 'server1_2'),
    'transfer_in_day' => array(
        'servers' => 'server1_3'),
    'api_tracking' => array(
        'servers' => 'server1_9'),
    'policy_config' => array(
        'servers' => 'server1_10'),
    'lock_flag' => array(
        'servers' => 'server1_14'),
    //db 15 for queue

    '__server1_0__' => array('host' => $host, 'port' => $port, 'auth' => $auth),
    '__server1_1__' => array('host' => $host, 'port' => $port, 'auth' => $auth, 'db' => 1),
    '__server1_2__' => array('host' => $host, 'port' => $port, 'auth' => $auth, 'db' => 2),
    '__server1_3__' => array('host' => $host, 'port' => $port, 'auth' => $auth, 'db' => 3),
    '__server1_4__' => array('host' => $host, 'port' => $port, 'auth' => $auth, 'db' => 9),
    '__server1_10__' => array('host' => $host, 'port' => $port, 'auth' => $auth, 'db' => 10),
    '__server1_14__' => array('host' => $host, 'port' => $port, 'auth' => $auth, 'db' => 14),
    '__server1_15__' => array('host' => $host, 'port' => $port, 'auth' => $auth, 'db' => 15),
);