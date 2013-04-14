<?php

/**
 * @author Weavora Team <hello@weavora.com>
 * @link http://weavora.com
 * @copyright Copyright (c) 2011 Weavora LLC
 */


require_once dirname(__FILE__) . '/mc_api_skd.php';

class RestClient
{
	//---
	protected $apiKey;
    protected $apiSecret;
	public $urlBase = 'http://localhost/mc_billing/public/api/';
    public $rawResponse;
    public $response;
    public $httpCode;
    public $ssl_verifypeer = FALSE;
    public $timeout = 30;
    /* Set connect timeout. */
    public $connecttimeout = 30;
    public $useragent = 'TwitterOAuth v0.2.0-beta2';
    public $requestUrl;
    public $http_header;
    public $parameters;
    public $paramString;
    public $trackExeTime =0;
    public $startTime;
    public $endTime;

    public function __construct($apiKey, $apiSecret)
	{
		$this->apiKey = $apiKey;
		$this->apiSecret = $apiSecret;
	}

	public function get($url, $params = array('format' => 'json'))
	{
		return $this->httpRequest($url, 'GET', $params);
	}

	public function post($url, $params = null)
	{
		return $this->httpRequest($url, 'POST', $params);
	}

	public function delete($url, $params = array('format' => 'json'))
	{
		return $this->httpRequest($url, 'DELETE', $params);
	}

	public function put($url, $params = array('format' => 'json'))
	{
		return $this->httpRequest($url, 'PUT', $params);
	}

	protected function _convertParams($params)
	{
		return $result = http_build_query($params);
	}

	public function getHttpCode()
	{
		return $this->httpCode;
	}

	public function httpRequest($url, $method = "GET", $parameters = null)
	{
        if (strrpos($url, 'https://') !== 0 && strrpos($url, 'http://') !== 0) {
            $url = "{$this->urlBase}{$url}";
        }

        $consumer = new \MCApiConsumer($this->apiKey, $this->apiSecret);
        $request = \MCApiRequest::fromConsumer($consumer, $method, $url, $parameters);
        $request->signRequest(new ClientSignatureMethod_RSA_SHA1(), $consumer);

        $this->parameters = $request->getParameters();

        switch($method) {
            case "GET":
                $this->requestUrl = $request->toUrl();
                return $this->http($request->toUrl(), 'GET');
            default:
                $this->requestUrl = $request->getNormalizedHttpUrl();
                return $this->http($request->getNormalizedHttpUrl(), $method, $request->toPostData());
        }
	}

    public function http($url, $method, $parameters= null) {
        $this->paramString = $parameters;
        $ci = curl_init();
        /* Curl settings */

        curl_setopt($ci, CURLOPT_USERAGENT, $this->useragent);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->connecttimeout);
        curl_setopt($ci, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ci, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, $this->ssl_verifypeer);
        curl_setopt($ci, CURLOPT_HEADERFUNCTION, array($this, 'getHeader'));
        curl_setopt($ci, CURLOPT_HEADER, false);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
        switch ($method) {
            case 'POST':
                curl_setopt($ci, CURLOPT_POST, true);
                if (!empty($parameters)) {
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $parameters);
                }
                break;
            case 'DELETE':
                if (!empty($parameters)) {
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $parameters);
                }
                curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
            case 'PUT':

                curl_setopt($ci, CURLOPT_CUSTOMREQUEST, "PUT");
                if (!empty($parameters)) {
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $parameters);
                }
                break;
            case 'GET':
                curl_setopt($ci, CURLOPT_CUSTOMREQUEST, "GET");
                if (!empty($parameters)) {
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $parameters);
                }
                break;
        }
//        echo $url; exit;
        curl_setopt($ci, CURLOPT_URL, $url);
        $this->startTime = explode(' ', microtime());
        $response = curl_exec($ci);
        $this->endTime = explode(' ', microtime());
        $this->trackExeTime += ($this->endTime[1]+$this->endTime[0]) - ($this->startTime[1]+$this->startTime[0]);
        $this->httpCode = curl_getinfo($ci, CURLINFO_HTTP_CODE);
        curl_close($ci);
        $this->rawResponse = $response;
//        print_r($response);
        $this->response = json_decode($response, true);
        return $this->response;
    }

    /**
     * Get the header info to store.
     */
    function getHeader($ch, $header) {
        $i = strpos($header, ':');
        if (!empty($i)) {
            $key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
            $value = trim(substr($header, $i + 2));
            $this->http_header[$key] = $value;
        }
        return strlen($header);
    }
}