<?php
return array(
    'core' => array(
        'adapter' => 'mysqli', //sqlite, mysql, mssql, oracle or pgsql
        'dsn' => 'mysql:host=192.168.50.62;dbname=mc_billing',
        'db_user' => 'root',
        'db_pass' => 'abc@123',
        'cache_prepare' => true,
        'slaves' => array(
            /*'slave1' => array(
                'adapter' => 'mysql',
                'weight' => 2,
                'dsn' => 'mysql:host=localhost;dbname=mc_corebilling',
                'db_user' => 'root',
                'db_pass' => 'abc@123',
            ),
            'slave2' => array(
                'adapter' => 'mysql',
                'weight' => 1,
                'dsn' => 'mysql:host=localhost;dbname=mc_corebilling',
                'db_user' => 'root',
                'db_pass' => 'abc@123',
            ),*/
        ),
    ),
    '__default__' => 'core'
);