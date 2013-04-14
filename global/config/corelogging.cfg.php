<?php
return array(
    'handler' => array(
        'adapter' => 'MongoDB',
        'dsn' => 'mongodb://192.168.50.62:27017,192.168.50.62:27018,192.168.50.62:27019',
        'options' => array(
            "db" => "core_logging",
            "replicaSet" => "rs0")
    ),
);