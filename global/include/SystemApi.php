<?php
\Flywheel\Loader::import('global.include.CoreApi', true);

class SystemApiServer extends \CoreApi\Server {
    public function __construct($data_store) {
        parent::__construct($data_store);
        $this->addSignatureMethod(new \CoreApi\SignatureMethod_HMAC_SHA1());
//        $this->addSignatureMethod(new SystemApiSignatureMethod_RSA_SHA1());
    }
}

class SystemApiDataStore extends \CoreApi\DataStore {
    public function lookupConsumer($consumer_key)
    {
        $consumer = Consumer::retrieveByKey($consumer_key);

        if (!$consumer) {
            throw new \CoreApi\Exception('Consumer not found');
        }

        if (\Consumer::STATUS_ACTIVE != $consumer->status) {
            throw new \CoreApi\Exception('Consumer not active');
        }

        $consumer = new \CoreApi\Consumer($consumer->key, $consumer->secret);
        return $consumer;
    }

    /**
     * @param \CoreApi\Consumer $consumer
     * @param string $nonce
     * @param int $timestamp
     * @return bool
     */
    public function lookupNonce($consumer, $nonce, $timestamp) {}
}

class SystemApiSignatureMethod_RSA_SHA1 extends \CoreApi\SignatureMethod_RSA_SHA1 {
    /**
     * @param \CoreApi\Request $request
     * @param \CoreApi\Consumer $consumer
     * @throws CoreException
     * @return string
     */
    protected function fetchPublicCert(&$request, $consumer)
    {
        $dbConsumer = \Consumer::retrieveByKey($consumer->key);
        if (!$dbConsumer) {
            throw new CoreException("Consumer information not found match with key {$consumer->key}");
        }
        $cert = <<<EOD
$dbConsumer->public_key
EOD;

        return $cert;
    }

    protected function fetchPrivateCert(&$request, $consumer) {
        return '';
    }
}
