<?php
$r = array(
    '__urlSuffix__' => '.html',
    '__remap__' => array(
        'route' => 'frontend/default'
    ),
    '/' => array(
        'route' => 'frontend/default'
    ),
    '{controller}' => array(
        'route' => '{controller}/default'
    ),
    '{controller}/{action}' => array(
        'route' => '{controller}/{action}'
    ),
    '{controller}/{action}/{id:\d+}' => array(
        'route' => '{controller}/{action}'
    ),
    'danh-muc/{slug:[a-zA-Z0-9-]+}-{id:\d+}' => [
        'route' => 'category/default'
    ],
    'bai-viet/{slug:[a-zA-Z0-9-]+}-{id:\d+}' => [
        'route' => 'post/detail'
    ],
    'nhom-san-pham/{slug:[a-zA-Z0-9-]+}-{id:\d+}' => [
        'route' => 'products/category'
    ],
    'san-pham/{slug:[a-zA-Z0-9-]+}-{id:\d+}' => [
        'route' => 'products/detail'
    ],
    'gio-hang' => [
        'route' => 'products/cart'
    ],
);
$r = \Toxotes\Cms::route($r);
return $r;