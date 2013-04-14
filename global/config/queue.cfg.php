<?php
$host = '192.168.50.62';
$port = 6379;
$auth = 'SMRz34aL';
return array(
    'api' => array(
        'adapter' => 'redis',
        'name' => 'api_background_queue',
        'config' => array(
            'dsn' => "$host:$port/15", //host:port/database
            'auth' => $auth
        ),
    ),

    'dispatch_event' => array(
        'adapter' => 'redis',
        'name' => 'dispatch_event_queue',
        'config' => array(
            'dsn' => "$host:$port/15",
            'auth' => $auth
        ),
    ),

    //repeat dispatch event repeat after 3 minutes
    'dispatch_event_3m' => array(
        'adapter' => 'redis',
        'name' => 'dispatch_event_3m_queue',
        'config' => array(
            'dsn' => "$host:$port/15",
            'auth' => $auth
        ),
    ),

    //repeat dispatch event repeat after 15 minutes
    'dispatch_event_15m' => array(
        'adapter' => 'redis',
        'name' => 'dispatch_event_15m_queue',
        'config' => array(
            'dsn' => "$host:$port/15",
            'auth' => $auth
        ),
    )
);