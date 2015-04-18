<?php

namespace Reservat\Core;

use Reservat\Core\Config;
use Monolog\Logger;
use Monolog\Handler\SlackHandler;
use Monolog\Handler\StreamHandler;

class Log
{

    protected static $instance = null;
    protected static $log = null;
    protected static $config;

    public function __construct()
    {

        $config = static::$config->log['slack'];

        $file_path = RESERVAT_DIR . '/../log';

        // TODO: maybe add file logging for lower errors

        static::$log = new Logger('bookings');

        if (static::$config->LOG_LEVEL < Logger::ERROR) {
            static::$log->pushHandler(
                new SlackHandler(
                    static::$config->LOG_SLACK_TOKEN,
                    static::$config->LOG_SLACK_CHANNEL,
                    static::$config->LOG_SLACK_USERNAME,
                    true,
                    static::$config->LOG_SLACK_EMOTE,
                    Logger::ERROR
                )
            );
        }

        if (static::$config->LOG_LEVEL < Logger::DEBUG) {
            if ($file_path) {
                if (!is_dir($file_path)) {
                    mkdir($file_path);
                }
                static::$log->pushHandler(new StreamHandler($file_path . '/bookings.log', Logger::DEBUG));
            }
        }

        static::$instance = $this;

    }

    public static function setConfig($config)
    {
        static::$config = $config;
    }

    public static function log($func, $args)
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        static::$log->$func($args);
    }

    public static function __callstatic($func, $args)
    {
        static::log($func, implode($args));
    }
}
