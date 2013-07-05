<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nobita
 * Date: 7/5/13
 * Time: 11:02 AM
 * To change this template use File | Settings | File Templates.
 */

namespace FlyApi;


class ErrorHandler {
    static private $_format = 'json';

    public static function printExceptionInfo(\Exception $e) {
        if (($e instanceof \CoreApi\Exception) || ($e instanceof \Flywheel\Exception\Api)) {
            self::printError($e->getCode(), $e->getMessage());
        } else {
            if ($app = Base::getApp() && Base::ENV_PRO != Base::getEnv()) {
                \Flywheel\Exception::outputStackTrace($e, 'none');
            }

            self::printError($e->getCode());
        }
    }

    private static function _responseError($code, $error) {
        $response = new \stdClass();
        if (!is_array($error)) {
            switch ($code) {
                case 400:
                    $error = array(
                        'code' => 400,
                        'message' => $error,
                    );
                    break;
                case 401:
                    $error = array(
                        'code' => 401,
                        'message' => $error,
                    );
                    break;
                case 403:
                    $error = array(
                        'code' => 403,
                        'message' => $error,
                    );
                    break;
                case 404:
                    $error = array(
                        'code' => 404,
                        'message' => $error,
                    );
                    break;
                case 406:
                    $error = array(
                        'code' => 406,
                        'message' => $error,
                    );
                    break;
                case 500:
                    $error = array(
                        'code' => 500,
                        'message' => $error,
                    );
                    break;
                case 502:
                    $error = array(
                        'code' => 502,
                        'message' => $error,
                    );
                    break;
                case 503:
                    $error = array(
                        'code' => 503,
                        'message' => $error,
                    );
                    break;

            }
        }

        $response->hash = array(
            'request' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'? 'https://':'http://')
            .$_SERVER['HTTP_HOST']
            .$_SERVER['REQUEST_URI'],
            'errors' => array($error),
        );

        if (400 != $code) {
            $response->hash['api'] = $_SERVER['REQUEST_METHOD'] .' ' .self::_getRequestInfo();
            $response->hash['format'] = self::$_format;
        }

        return $response;
    }

    public static function printError($code, $body = null) {
        while (ob_get_level()) {
            if (!ob_end_clean()) {
                break;
            }
        }

        if (!headers_sent()) {
            if (null == $code) {
                $code = '500';
            }

            $headMsg = self::_getHeaderMessage($code);

            header("HTTP/1.1 $code $headMsg");
        }

        $response = self::_responseError($code, $body);
        $format = self::$_format;
        switch ($format) {
            case 'xml' :
                header('Content-type:text/xml');
                break;
            case 'text':
                break;
            default:
                header('Content-type:application/json');
                $response = json_encode($response);

        }

        echo $response;
        exit;
    }

    private static function _getRequestInfo() {
        if (isset($_SERVER['PATH_INFO']) && ($_SERVER['PATH_INFO'] != '')) {
            $pathInfo = $_SERVER['PATH_INFO'];
        }
        else {
            $pathInfo = preg_replace('/^'.preg_quote($_SERVER['SCRIPT_NAME'], '/').'/', '', $_SERVER['REQUEST_URI']);
            $pathInfo = preg_replace('/^'.preg_quote(preg_replace('#/[^/]+$#', '', $_SERVER['SCRIPT_NAME']), '/').'/', '', $pathInfo);
            $pathInfo = preg_replace('/\??'.preg_quote($_SERVER['QUERY_STRING'], '/').'$/', '', $pathInfo);
            if ($pathInfo == '') $pathInfo = '/';
        }

        $segment = explode('/', $pathInfo);
        $_cf = explode('.', end($segment)); //check define format
        if (isset($_cf[1])) {
            self::$_format = $_cf[1];
        }

        return ltrim($pathInfo, '/');
    }

    private static function _getHeaderMessage($code) {
        switch ($code) {
            case 400:
                return 'Bad Request';
            case 401:
                return 'Unauthorized';
            case 403:
                return 'Forbidden';
            case 404:
                return 'Not Found';
            case 406:
                return 'Not Acceptable';
            case 500:
                return 'Internal Server Error';
            case 502:
                return 'Bad Gateway';
            case 503:
                return 'Service Unavailable';
        }
    }
}