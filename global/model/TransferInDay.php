<?php
use Flywheel\Redis\RedisClient;

class TransferInDay {
    public static function getAmount($account, $scope) {
        $scope = strtoupper($scope);
        return (float) RedisClient::getConnection('transfer_in_day')->get(REDIS_TID."_{$scope}_{$account}_" .date('d-m-Y'));
    }

    public static function increment($account, $amount, $scope) {
        $key = REDIS_TID .'_' .strtoupper($scope) .'_' .$account .'_' .date('d-m-Y');
        return RedisClient::getConnection('transfer_in_day')->incrByFloat($key, $amount);
    }
}
