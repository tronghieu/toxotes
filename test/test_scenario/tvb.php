<?php
require_once __DIR__ .'/RestClient.php';

$client = new RestClient('LsEpjnSGJm8nFU2BaLprdDtUBb', 'p1uSoATIucROaph8UstL65lEdrL8spIapRi5H4Edro4SwIEH832OUR5e');
$client->urlBase = 'https://210.211.99.170:8090/api';

$r = $client->http($client->urlBase.'/v1/order', 'POST',
    'nonce=32381343&signature_method=HMAC-SHA1&net_cost=30000&order_code=demo0000111&signature=xKf1jMKl0ntmV9p%2BXwyqbiTd1nc%3D&timestamp=1365504678&consumer_key=LsEpjnSGJm8nFU2BaLprdDtUBb&callback_success=http%3A%2F%2F127.0.0.1%2Fok&callback_fail=http%3A%2F%2F127.0.0.1%2Ffail'
);

print_r($r);