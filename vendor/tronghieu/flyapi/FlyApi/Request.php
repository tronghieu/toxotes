<?php
namespace FlyApi;


class Request {
    private $_parameters;
    private $_httpMethod;
    private $_httpUrl;
    public $baseString;
    public static $POST_INPUT = 'php://input';

    function __construct($http_method, $http_url, $parameters=NULL) {
        @$parameters or $parameters = array();
        $parameters = array_merge( Util::parseParameters(parse_url($http_url, PHP_URL_QUERY)), $parameters);
        $this->_parameters = $parameters;
        $this->_httpMethod = $http_method;
        $this->_httpUrl = $http_url;
    }

    /**
     * attempt to build up a request from what was passed to the server
     */
    public static function fromRequest($http_method=NULL, $http_url=NULL, $parameters=NULL) {
        $scheme = (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on")
            ? 'http'
            : 'https';
        @$http_url or $http_url = $scheme .
                '://' . $_SERVER['HTTP_HOST'] .
                ':' .
                $_SERVER['SERVER_PORT'] .
                $_SERVER['REQUEST_URI'];
        @$http_method or $http_method = $_SERVER['REQUEST_METHOD'];

        // We weren't handed any parameters, so let's find the ones relevant to
        // this request.
        // If you run XML-RPC or similar you should use this to provide your own
        // parsed parameter-list
        if (!$parameters) {
            // Find request headers
            $request_headers = Util::getHeaders();

            // Parse the query-string to find GET parameters
            $parameters = Util::parseParameters($_SERVER['QUERY_STRING']);

            // It's a POST request of the proper content-type, so parse POST
            // parameters and add those overriding any duplicates from GET
            if (($http_method == "POST" && @strstr($request_headers["Content-Type"], "application/x-www-form-urlencoded"))
                || $http_method == "PUT" || $http_method == "DELETE") {
                $post_data = Util::parseParameters(
                    file_get_contents(self::$POST_INPUT)
                );
                $parameters = array_merge($parameters, $post_data);
            }

            // We have a Authorization-header with OAuth data. Parse the header
            // and add those overriding any duplicates from GET or POST
            if (@substr($request_headers['Authorization'], 0, 6) == "OAuth ") {
                $header_parameters = Util::splitHeader(
                    $request_headers['Authorization']
                );
                $parameters = array_merge($parameters, $header_parameters);
            }

        }

        return new self($http_method, $http_url, $parameters);
    }

    /**
     * pretty much a helper function to set up the request
     */
    public static function fromConsumer($consumer, $http_method, $http_url, $parameters=NULL) {
        @$parameters or $parameters = array();
        $defaults = array(
            "nonce" => self::_generateNonce($consumer->key),
            "timestamp" => self::_generateTimestamp(),
            "consumer_key" => $consumer->key);

        $parameters = array_merge($defaults, $parameters);


        return new self($http_method, $http_url, $parameters);
    }

    public function signRequest(SignatureMethod $signature_method, $consumer) {
        /* @var SignatureMethod_RSA_SHA1 $signature */
        $this->setParameter(
            "signature_method",
            $signature_method->getName(),
            false
        );

        $signature = $this->buildSignature($signature_method, $consumer);
        $this->setParameter("signature", $signature, false);
    }

    public function buildSignature($signature_method, $consumer) {
        /* @var SignatureMethod_RSA_SHA1 $signature_method */
        $signature = $signature_method->buildSignature($this, $consumer);
        return $signature;
    }

    /**
     * Returns the base string of this request
     *
     * The base string defined as the method, the url
     * and the parameters (normalized), each urlencoded
     * and the concated with &.
     */
    public function getSignatureBaseString() {
        $parts = array(
            $this->getNormalizedHttpMethod(),
            $this->getNormalizedHttpUrl(),
            $this->getSignableParameters()
        );

        $parts = Util::urlEncodeRfc3986($parts);

        return implode('&', $parts);
    }

    /**
     * just uppercases the http method
     */
    public function getNormalizedHttpMethod() {
        return strtoupper($this->_httpMethod);
    }

    /**
     * parses the url and rebuilds it to be
     * scheme://host/path
     */
    public function getNormalizedHttpUrl() {
        $parts = parse_url($this->_httpUrl);

        $port = @$parts['port'];
        $scheme = $parts['scheme'];
        $host = $parts['host'];
        $path = @$parts['path'];

        $port or $port = ($scheme == 'https') ? '443' : '80';

        if (($scheme == 'https' && $port != '443')
            || ($scheme == 'http' && $port != '80')) {
            $host = "$host:$port";
        }
        return "$scheme://$host$path";
    }

    /**
     * The request parameters, sorted and concatenated into a normalized string.
     * @return string
     */
    public function getSignableParameters() {
        // Grab all parameters
        $params = $this->_parameters;

        // Remove oauth_signature if present
        // Ref: Spec: 9.1.1 ("The oauth_signature parameter MUST be excluded.")
        if (isset($params['signature'])) {
            unset($params['signature']);
        }

        return Util::buildRawHttpQuery($params);
    }

    private static function _generateNonce($consumerKey) {
        $mt = microtime() .uniqid($consumerKey, true);
        $rand = mt_rand();
        return md5($mt . $rand); // md5s look nicer than numbers
    }

    private static function _generateTimestamp() {
        return time();
    }

    public function setParameter($name, $value, $allow_duplicates = true) {
        if ($allow_duplicates && isset($this->_parameters[$name])) {
            // We have already added parameter(s) with this name, so add to the list
            if (is_scalar($this->_parameters[$name])) {
                // This is the first duplicate, so transform scalar (string)
                // into an array so we can add the duplicates
                $this->_parameters[$name] = array($this->_parameters[$name]);
            }

            $this->_parameters[$name][] = $value;
        } else {
            $this->_parameters[$name] = $value;
        }
    }

    public function getParameter($name) {
        return isset($this->_parameters[$name]) ? $this->_parameters[$name] : null;
    }

    public function getParameters() {
        return $this->_parameters;
    }

    public function unsetParameter($name) {
        unset($this->_parameters[$name]);
    }

    /**
     * builds the data one would send in a POST request
     */
    public function toPostData() {
        return Util::buildHttpQuery($this->_parameters);
    }

    /**
     * builds a url usable for a GET request
     */
    public function toUrl() {
        $post_data = $this->toPostData();
        $out = $this->getNormalizedHttpUrl();
        if ($post_data) {
            $out .= '?'.$post_data;
        }
        return $out;
    }

    public function __toString() {
        return $this->toUrl();
    }
}