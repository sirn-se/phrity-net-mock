<?php

namespace Phrity\Net\Mock\Stack;

/**
 * Runnable item for stack.
 */
class StackItem
{
    private $asserts = [];
    private $return = null;

    public function __construct(callable|null $assert = null)
    {
        if ($assert) {
            $this->addAssert($assert);
        }
    }

    public function addAssert(callable $assert): self
    {
        $this->asserts[] = $assert;
        return $this;
    }

    public function setReturn(callable $return): self
    {
        $this->return = $return;
        return $this;
    }

    public function __invoke(string $method, array $params, callable $default, object $instance)
    {
        foreach ($this->asserts as $assert) {
            call_user_func($assert, $method, $params);
        }
        return $this->return
            ? call_user_func($this->return, $params, $default, $instance)
            : $default($params);
    }
}
