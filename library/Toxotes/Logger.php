<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 12/14/14
 * Time: 6:53 AM
 */

namespace Toxotes;


use Flywheel\Config\ConfigHandler;
use Flywheel\Log\Handler\RotatingFileHandler;

class Logger extends \Flywheel\Log\Logger {
    protected static $_instances = array();

    /**
     * factory Logger by channel
     *
     * @param $channel
     * @return \Flywheel\Log\Logger
     */
    public static function factory($channel) {
        if (!isset(self::$_instances[$channel])) {
            $logger = new self($channel);
            $loggerConfig = ConfigHandler::get('logger');
            $path = $loggerConfig['path'];

            $debug  = $loggerConfig['debug']
                ? $loggerConfig['debug']:Logger::INFO;

            $filePath = $path.strtolower($channel);

            $logger->pushHandler(new RotatingFileHandler($filePath, 60, $debug));
            $logger->pushProcessor(array(__CLASS__,'errorHandle'));
            self::$_instances[$channel] = $logger;
        }
        return self::$_instances[$channel];
    }

    public static function errorHandle($record) {
        $traces = array_reverse(debug_backtrace());
        $trace = $traces[0];
        //do something here
        return $record;
    }
} 