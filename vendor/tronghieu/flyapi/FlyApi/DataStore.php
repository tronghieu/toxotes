<?php
namespace FlyApi;


abstract class DataStore {
    abstract function lookupConsumer($consumer_key);

    abstract function lookupNonce($consumer, $nonce, $timestamp);
}