<?php
namespace FlyApi;


abstract class SignatureMethod_RSA_SHA1 extends SignatureMethod {
    public function getName() {
        return "RSA-SHA1";
    }

    // Up to the SP to implement this lookup of keys. Possible ideas are:
    // (1) do a lookup in a table of trusted certs keyed off of consumer
    // (2) fetch via http using a url provided by the requester
    // (3) some sort of specific discovery code based on request
    //
    // Either way should return a string representation of the certificate
    protected abstract function _fetchPublicCert(&$request);

    // Up to the SP to implement this lookup of keys. Possible ideas are:
    // (1) do a lookup in a table of trusted certs keyed off of consumer
    //
    // Either way should return a string representation of the certificate
    protected abstract function _fetchPrivateCert(&$request);

    public function buildSignature(Request $request, Consumer $consumer) {
        $baseString = $request->getSignatureBaseString();
        $request->baseString = $baseString;

        // Fetch the private key cert based on the request
        $cert = $this->_fetchPrivateCert($request);

        // Pull the private key ID from the certificate
        $privateKey = openssl_get_privatekey($cert);

        // Sign using the key
        $ok = openssl_sign($baseString, $signature, $privateKey);

        // Release the key resource
        openssl_free_key($privateKey);

        return base64_encode($signature);
    }

    public function checkSignature(Request $request, Consumer $consumer, $signature) {
        $decoded_sig = base64_decode($signature);

        $base_string = $request->getSignatureBaseString();

        // Fetch the public key cert based on the request
        $cert = $this->_fetchPublicCert($request);

        // Pull the public key ID from the certificate
        $publicKey = openssl_get_publickey($cert);

        // Check the computed signature against the one passed in the query
        $ok = openssl_verify($base_string, $decoded_sig, $publicKey);

        // Release the key resource
        openssl_free_key($publicKey);

        return $ok == 1;
    }
}