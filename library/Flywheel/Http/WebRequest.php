<?php
namespace Flywheel\Http;
use Flywheel\Base;
use Flywheel\Factory;

class WebRequest extends Request
{
    /**
     * @var boolean whether cookies should be validated to ensure they are not tampered. Defaults to false.
     */
    public $enableCookieValidation=false;

    /**
     * @var array the property values (in name-value pairs) used to initialize the CSRF cookie.
     * Any property of {@link CHttpCookie} may be initialized.
     * This property is effective only when {@link enableCsrfValidation} is true.
     */
    public $csrfCookie;

    protected $_csrfToken;

    public function init() {}

    /**
     * Returns true if the request is a XMLHttpRequest.
     *
     * It works if your JavaScript library set an X-Requested-With HTTP header.
     * Works with Prototype, Mootools, jQuery, and perhaps others.
     *
     * @return bool true if the request is an XMLHttpRequest, false otherwise
     */
    public function isXmlHttpRequest() {
        return ($this->getHttpHeader('X_REQUESTED_WITH') == 'XMLHttpRequest');
    }

    /**
     * Returns information about the capabilities of user browser.
     * @param string $userAgent the user agent to be analyzed. Defaults to null, meaning using the
     * current User-Agent HTTP header information.
     * @return array user browser capabilities.
     * @see http://www.php.net/manual/en/function.get-browser.php
     */
    public function getBrowser($userAgent=null)
    {
        return get_browser($userAgent,true);
    }

    /**
     * Returns the content type of the current request.
     * @param  Boolean $trim If false the full Content-Type header will be returned
     * @return string
     */
    public function getContentType($trim = true)
    {
        $contentType = $this->getHttpHeader('Content-Type', null);
        if ($trim && false !== $pos = strpos($contentType, ';'))
            $contentType = substr($contentType, 0, $pos);
        return $contentType;
    }

    /**
     * Redirects the browser to the specified URL.
     * @param string $url URL to be redirected to. If the URL is a relative one, the base URL of
     * the application will be inserted at the beginning.
     * @param int $code the HTTP status code. Defaults to 302. See {@link http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html}
     * @param bool $end whether to terminate the current application
     */
    public static function redirect($url, $code = 302, $end = true) {
        if (strpos($url, 'http') !== 0) { //not entire url
            $baseUrl = Factory::getRouter()->getBaseUrl();
            if (false === strpos($baseUrl, '.php')) {
                $baseUrl = rtrim($baseUrl, '/') .'/';
            }
            $url = $baseUrl .ltrim($url,'/');
        }
        header('Location: '.$url, true, $code);
        if (true == $end)
            Base::end();
    }
}
