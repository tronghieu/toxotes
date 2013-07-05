<?php
namespace FlyApi;


class Server {
    public $timestampThreshold = 300; // in seconds, five minutes

    /*
     * @var SignatureMethod[]
     */
    protected $_signatureMethods = array();

    /**
     * @var DataStore
     */
    protected $_dataStore;

    public function __construct(DataStore $dataStore)
    {
        $this->_dataStore = $dataStore;
    }

    public function addSignatureMethod(SignatureMethod $signatureMethod)
    {
        $this->_signatureMethods[$signatureMethod->getName()] = $signatureMethod;
    }

    /**
     * figure out the signature with some defaults
     *
     * @param Request $request
     * @throws Exception
     * @return SignatureMethod
     */
    private function _getSignatureMethod(Request &$request) {
        $signature_method =
            @$request->getParameter("signature_method");

        if (!$signature_method) {
            // According to chapter 7 ("Accessing Protected Ressources") the signature-method
            // parameter is required, and we can't just fallback to PLAINTEXT
            throw new Exception('No signature method parameter. This parameter is required', 400);
        }

        if (!in_array($signature_method,
            array_keys($this->_signatureMethods))) {
            throw new Exception("Signature method '$signature_method' not supported try one of the following: " .
            implode(", ", array_keys($this->_signatureMethods)), 400);
        }
        return $this->_signatureMethods[$signature_method];
    }

    public function getConsumer(Request &$request)
    {
        $consumer_key = @$request->getParameter("consumer_key");
        if (!$consumer_key) {
            throw new Exception("Invalid consumer key", 400);
        }

        $consumer = $this->_dataStore->lookupConsumer($consumer_key);
        if (!$consumer) {
            throw new Exception("Invalid consumer", 400);
        }

        return $consumer;
    }

    /**
     * all-in-one function to check the signature on a request
     * should guess the signature method appropriately
     *
     * @param Request $request
     * @param Consumer $consumer
     * @throws Exception
     */
    private function _checkSignature(Request &$request, Consumer $consumer) {
        // this should probably be in a different method
        $timestamp = @$request->getParameter('timestamp');
        $nonce = @$request->getParameter('nonce');

        $this->_checkTimestamp($timestamp);

        $this->_checkNonce($consumer, $nonce, $timestamp);

        $signature_method = $this->_getSignatureMethod($request);

        /* @SignatureMethod_RSA_SHA1 $signature_method */
        $signature = $request->getParameter('signature');

        $valid_sig = $signature_method->checkSignature(
            $request,
            $consumer,
            $signature
        );

        if (!$valid_sig) {
            throw new Exception("Invalid signature", 403);
        }
    }

    /**
     * check that the nonce is not repeated
     */
    private function _checkNonce(Consumer $consumer, $nonce, $timestamp) {
        if(!$nonce) {
            throw new Exception('Missing nonce parameter. The parameter is required.', 400);
        }

        // verify that the nonce is uniqueish
        $found = $this->_dataStore->lookupNonce(
            $consumer,
            $nonce,
            $timestamp
        );

        if ($found) {
            throw new Exception("Nonce already used: {$nonce}", 400);
        }

    }

    /**
     * check that the timestamp is new enough
     */
    private function _checkTimestamp($timestamp) {
        if(!$timestamp) {
            throw new Exception("Missing timestamp parameter. The parameter is required", 400);
        }
        // verify that timestamp is recentish
        $now = time();
        if (abs($now - $timestamp) > $this->timestampThreshold) {
            throw new Exception("Expired timestamp, yours $timestamp, ours $now", 400);
        }
    }

    /**
     * verify an api call, checks all the parameters
     */
    public function verifyRequest(Request &$request) {
        $consumer = $this->getConsumer($request);
        $this->_checkSignature($request, $consumer);
        return array($consumer);
    }
}