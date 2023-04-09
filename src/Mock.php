<?php

/**
 * File for Net\Mock\Mock class.
 * @package Phrity > Net > Mock > Mock
 */

namespace Phrity\Net\Mock;

use Psr\Log\{
    LoggerInterface,
    NullLogger
};


/**
 * Phrity\Net\Mock\Mock class.
 */
class Mock
{
    private static $logger;
    private static $callback;
    private static $counter;

    public static function setLogger(LoggerInterface $logger): void
    {
        self::$logger = $logger;
    }

    public static function getLogger(): LoggerInterface
    {
        if (!isset(self::$logger)) {
            self::$logger = new NullLogger();
        }
        return self::$logger;
    }

    public static function setCallback(callable $callback): void
    {
        self::$callback = $callback;
        self::$counter = 0;
    }

    public static function getCallback(): callable
    {
        return self::$callback;
    }

    public static function runCallback(string $method, array $params, callable $default)
    {
        return self::$callback
            ? call_user_func(self::$callback, self::$counter++, $method, $params, $default)
            : call_user_func($default, $params);
    }
}