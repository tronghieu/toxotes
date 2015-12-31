<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 3/1/15
 * Time: 5:20 PM
 */

namespace Toxotes;


use Flywheel\Filesystem\Filesystem;

class ErrorHandler {
    static private $_format = 'json';

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

    public static function getClientIp() {
        if (getenv('HTTP_CLIENT_IP')) {
            $ipAddress = getenv('HTTP_CLIENT_IP');
        }
        else if(getenv('HTTP_X_FORWARDED_FOR')) {
            $ipAddress = getenv('HTTP_X_FORWARDED_FOR');
        }
        else if(getenv('HTTP_X_FORWARDED')) {
            $ipAddress = getenv('HTTP_X_FORWARDED');
        }
        else if(getenv('HTTP_FORWARDED_FOR')) {
            $ipAddress = getenv('HTTP_FORWARDED_FOR');
        }
        else if(getenv('HTTP_FORWARDED')) {
            $ipAddress = getenv('HTTP_FORWARDED');
        }
        else if(getenv('REMOTE_ADDR')) {
            $ipAddress = getenv('REMOTE_ADDR');
        }
        else {
            $ipAddress = 'UNKNOWN';
        }

        return $ipAddress;
    }

    public static function errorHandling($code, $message, $file, $line) {
        if($code && error_reporting(E_ERROR | E_WARNING | E_PARSE)) {
            // disable error capturing to avoid recursive errors
            restore_error_handler();

            switch ($code) {
                case E_USER_ERROR:
                    $message = 'ERROR [' .self::getClientIp() .' ' .date('Y-m-d H:i:s') .']' . $message;
                    break;
                case E_USER_NOTICE:
                    $message = 'NOTICE [' .self::getClientIp() .' ' .date('Y-m-d H:i:s')  .']' . $message;
                    break;
                case E_USER_WARNING:
                    $message = 'WARNING [' .self::getClientIp() .' ' .date('Y-m-d H:i:s')  .']' . $message;
                    break;
                case E_USER_DEPRECATED:
                    $message = 'DEPRECATED [' .self::getClientIp() .' ' .date('Y-m-d H:i:s')  .']' .$message;
                    break;
            }

            $log = $message.' in ' .$file .' line ' .$line ."n\tStack trace:\r\n";

            $trace = array_slice(debug_backtrace(),1 , 6);

            $count = count($trace);

            for ($i = 0; $i < $count; ++$i) {

                if(!isset($trace[$i]['file'])) {
                    $trace[$i]['file']='unknown';
                }
                if(!isset($trace[$i]['line'])) {
                    $trace[$i]['line']=0;
                }
                if(!isset($trace[$i]['function'])) {
                    $trace[$i]['function']='unknown';
                }

                $log.= "\t#{$i} {$trace[$i]['file']} ({$trace[$i]['line']}): ";
                if(isset($t['object']) && is_object($t['object']))
                    $log.=get_class($t['object']).'->';
                $log.= $trace[$i]['function'] ."()\r\n";
            }

            if(isset($_SERVER['REQUEST_URI'])) {
                $log .='REQUEST_URI=' .$_SERVER['REQUEST_URI'];
            }

            $log .= "\r\n";

            $path = RUNTIME_PATH .'/log/phperr-' .date('Y-m-d') .'.log';

            if(!file_exists($path)) {
                $filesystem = new Filesystem();
                $filesystem->dumpFile($path, $log, 0777);
            }else{
                file_put_contents($path, $log, FILE_APPEND);
            }

            return $log;
        }
        return false;
    }

    /**
     * @param \Exception $e
     * @return bool
     */
    public static function exceptionHandling($e) {
        $message = 'Exception [' .self::getClientIp() .' ' .date('Y-m-d H:i:s') .']' . $e->getMessage();

        $log = $message.' in ' .$e->getFile() .' line ' .$e->getLine() ."n\tStack trace:\r\n";

        $trace = array_slice($e->getTrace(),1 , 6);

        $count = count($trace);

        for ($i = 0; $i < $count; ++$i) {

            if(!isset($trace[$i]['file'])) {
                $trace[$i]['file'] = 'unknown';
            }
            if(!isset($trace[$i]['line'])) {
                $trace[$i]['line'] = 0;
            }
            if(!isset($trace[$i]['function'])) {
                $trace[$i]['function'] = 'unknown';
            }

            $log .= "\t#{$i} {$trace[$i]['file']} ({$trace[$i]['line']}): ";
            if(isset($t['object']) && is_object($t['object']))
                $log .= get_class($t['object']).'->';
            $log .= $trace[$i]['function'] ."()\r\n";
        }

        if(isset($_SERVER['REQUEST_URI'])) {
            $log .='REQUEST_URI=' .$_SERVER['REQUEST_URI'];
        }

        $log .= "\r\n";

        $filename = 'exception-' .date('Y-m-d') .'.log';

        $path = RUNTIME_PATH .'/log/'.$filename;

        if(!file_exists($path)) {
            $filesystem = new Filesystem();
            $filesystem->dumpFile($path, $log, 0777);
        }else{
            file_put_contents($path, $log, FILE_APPEND);
        }

        return true;
    }
}