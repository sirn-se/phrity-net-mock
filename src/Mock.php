<?php

namespace Phrity\Net\Mock;

use Closure;
use Psr\Log\{
    LoggerInterface,
    NullLogger
};

/**
 * Phrity\Net\Mock\Mock class.
 */
class Mock
{
    private static LoggerInterface|null $logger = null;
    private static Closure|null $callback  = null;
    private static int $counter;

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

    public static function setCallback(Closure $callback): void
    {
        self::$counter = 0;
        self::$callback = $callback;
    }

    /**
     * @param list<mixed> $params
     */
    public static function runCallback(string $method, array $params, Closure $default, object $instance): mixed
    {
        return self::$callback
            ? call_user_func(self::$callback, self::$counter++, $method, $params, $default, $instance)
            : call_user_func($default, $params);
    }
}
