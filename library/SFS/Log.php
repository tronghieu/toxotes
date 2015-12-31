<?php
namespace SFS;


use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\RotatingFileHandler;

class Log extends \Monolog\Logger {
    /**
     * @var \Monolog\Logger
     */
    protected static $instance;

    /**
     * @return \Monolog\Logger|Log
     */
    public static function getInstance() {
        if (null == self::$instance) {
            $logger = new self('default');
            $logger->pushHandler(new RotatingFileHandler(ROOT_DIR .'/runtime/log/slim', 30, self::DEBUG));
            $logger->pushHandler(new ErrorLogHandler(ErrorLogHandler::OPERATING_SYSTEM, self::ERROR));
            self::$instance = $logger;
        }

        return self::$instance;
    }

    public function write($message) {
        self::getInstance()->log(self::DEBUG, $message);
    }
} 