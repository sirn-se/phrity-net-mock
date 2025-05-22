<?php

namespace Phrity\Net\Mock\Stack;

use Closure;

/**
 * Runnable item for stack.
 */
class StackItem
{
    /** @var array<Closure> $asserts */
    private array $asserts = [];
    private mixed $return = null;

    public function __construct(Closure|null $assert = null)
    {
        if ($assert) {
            $this->addAssert($assert);
        }
    }

    public function addAssert(Closure $assert): self
    {
        $this->asserts[] = $assert;
        return $this;
    }

    public function setReturn(Closure $return): self
    {
        $this->return = $return;
        return $this;
    }

    /**
     * @param array<string, mixed> $params
     */
    public function __invoke(string $method, array $params, Closure $default, object $instance): mixed
    {
        foreach ($this->asserts as $assert) {
            call_user_func($assert, $method, $params);
        }
        return $this->return
            ? call_user_func($this->return, $params, $default, $instance)
            : $default($params);
    }
}
