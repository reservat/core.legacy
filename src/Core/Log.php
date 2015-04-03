<?php

namespace Reservat\Core;

use Reservat\Core\Config;
use Monolog\Logger;
use Monolog\Handler\SlackHandler;

class Log
{

    protected static $instance = null;
    protected static $log = null;

    public function __construct()
    {
        $config = new Config();
        $config = $config->log['slack'];

        // TODO: maybe add file logging for lower errors

        static::$log = new Logger('slack');
        static::$log->pushHandler(
            new SlackHandler(
                $config['token'],
                $config['channel'],
                $config['username'],
                true,
                $config['emote'],
                Logger::ERROR
            )
        );
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
