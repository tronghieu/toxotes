<?php
$private = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQD+KTWNke1yM3A7LoZwLNZZwQ3KAFz3HmW78Hznx6ZzArg4BJsF
0wYeNoL+XUrRJyYNFvjuLUt9Nty/da7Yk14ERutynKDaDZIjSCfh4eL+m+r+mEnU
F67Tn+5iwJcxSNucryWfZhqjC8V5TtrfRHoMzDge7T5xUpCErUGPGveUHQIDAQAB
AoGBANjgaz0xn49Ki2NE0R0ZdZNDJDQR2UJZovAbR0o02Djdwjqy22G970OKun65
NuWAZXzX9HSxG/BuBzItBpTyM075rTL8RWjihZ33X3d7EPVHkSjID79RNGGHB2RQ
5kn2ZUGKYGL9eDcjkTwVgLFjrT2LYe+MC+cNlS69leitFaJhAkEA//HwZxBcY7q7
zrFA6ne1Dq4FOFw3n+vlWj1MHDjMoThmoOupl061LQV9TJG9sAmo+qPBlQsqIri+
jXxV9KyWaQJBAP43LA8VD56wEyJxh6UIJDMdUnhNV+hQt8EW1yqAnL9DHarKGOa6
XcKDSQ/3BWN2sm8Cg51H2ZNe4kmNieMMoZUCQQCnuSFkOMmCpUUbnva+b/Hbi9hp
5ayiBRFIgHDW8bXPVMmUXLrHJ9H8jeNdgQhASyRME3HxPN7A4DYnO7qMW2k5AkBn
4+ZGl6XVhUGcnub/Y89fcElGztzxHSOrbokqXnswkt4p8QOyL1Gn731JX/s8xcJw
KYfeHAHn/yvdQVGrj3rtAkBmRTmXurOTamUseuhbaiyGIWH7PZLO4vGIQyF6e5pE
L0E4zg3RaQqvjhLadMxacx8ytLkvuS9G/ikFw7jAGMaC
-----END RSA PRIVATE KEY-----
EOD;


$public = <<<EOD
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQD+KTWNke1yM3A7LoZwLNZZwQ3K
AFz3HmW78Hznx6ZzArg4BJsF0wYeNoL+XUrRJyYNFvjuLUt9Nty/da7Yk14ERuty
nKDaDZIjSCfh4eL+m+r+mEnUF67Tn+5iwJcxSNucryWfZhqjC8V5TtrfRHoMzDge
7T5xUpCErUGPGveUHQIDAQAB
-----END PUBLIC KEY-----
EOD;

$signature = 'abc';
$baseString = 'xyz';

$privateKey = openssl_get_privatekey($private);

$ok = openssl_sign($baseString, $signature, $privateKey);

openssl_free_key($privateKey);

$publicKey = openssl_get_publickey($public);

$ok = openssl_verify($baseString, $signature, $publicKey);

openssl_free_key($publicKey);

var_dump($ok);
