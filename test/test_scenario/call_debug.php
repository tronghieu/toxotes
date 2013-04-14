<?php
require_once __DIR__ .'/RestClient.php';
$client = new RestClient('w4lu9roAvl0tHLestiADroarOe', '3Ustat6W2vUbRuWeXEMEwr7put4E3AMe7aBr6FATREtu5aZAtUgUd6b8');
$client->urlBase = 'http://192.168.50.62/mc_billing/public/api';
$r = $client->get('/v1/account/detail/ACC031314A5B880');
var_dump($r);
$r = $client->httpRequest('/v1/deposit', 'POST', array('currency' => 'VND',
    'acc_uk' => 'ACC031314A5B880',
    'amount' => '250000'));

var_dump($r);
if ($client->httpCode == 200) {
    $uk = $r['deposit_voucher']['uk'];
    $r = $client->httpRequest("/v1/deposit/detail/{$uk}", 'GET');
    var_dump($r);
    $r = $client->httpRequest('/v1/deposit/finish', 'PUT', array('deposit_key' => $uk));
    var_dump($r);
}
