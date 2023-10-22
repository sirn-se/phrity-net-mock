<?php

namespace Phrity\Net\Mock;

use Psr\Log\{
    LoggerInterface,
    NullLogger
};

/**
 * Phrity\Net\Mock\MockTrait trait.
 */
trait MockTrait
{
    private function mockHandle(?callable $default = null)
    {
        $trace = debug_backtrace(0, 2);
        $class = substr($trace[1]['class'], 16);
        $method = $trace[1]['function'];
        $params = $trace[1]['args'];

        Mock::getLogger()->debug("{$class}.{$method}", $params);
        $default = $default ?: function ($params) use ($method) {
            $parent = get_parent_class($this);
            return call_user_func_array("{$parent}::{$method}", $params);
        };
        return Mock::runCallback("{$class}.{$method}", $params, $default, $this);
    }
}
