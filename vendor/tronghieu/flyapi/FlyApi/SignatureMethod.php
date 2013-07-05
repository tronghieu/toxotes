<?php
namespace FlyApi;

abstract class SignatureMethod {
    abstract function getName();

    abstract public function buildSignature(Request $request, Consumer $consumer);

    /**
     * @param $request
     * @param $consumer
     * @param $signature
     * @return bool
     */
    public function checkSignature(Request $request, Consumer $consumer, $signature) {
        $built = $this->buildSignature($request, $consumer);
        return $built == $signature;
    }
}