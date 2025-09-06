<?php

namespace Phrity\Net\Mock;

use Closure;
use Psr\Log\{
    LoggerInterface,
    NullLogger
};

/**
 * Phrity\Net\Mock\MockTrait trait.
 */
trait MockTrait
{
    private function mockHandle(Closure|null $default = null): mixed
    {
        /** @var array<int, array{class: string, function: string, args: array<string, mixed>}> $trace */
        $trace = debug_backtrace(0, 2);
        $class = substr($trace[1]['class'], 16);
        $method = $trace[1]['function'];
        $params = $trace[1]['args'];

        Mock::getLogger()->debug("{$class}.{$method}", $params);
        $default = $default ?? function ($params) use ($method) {
            $parent = get_parent_class($this);
            /** @var callable $callback */
            $callback = [$parent, $method];
            return call_user_func_array($callback, $params);
        };
        return Mock::runCallback("{$class}.{$method}", $params, $default, $this);
    }
}
