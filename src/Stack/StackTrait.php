<?php

namespace Phrity\Net\Mock\Stack;

use Phrity\Net\Mock\Mock;

/**
 * Stack enabler trait..
 */
trait StackTrait
{
    private $stack_items = [];

    private function setUpStack(): void
    {
        $this->stack_items = [];
        Mock::setCallback(function (int $counter, string $method, array $params, callable $default) {
            $assert = array_shift($this->stack_items);
//echo " >>> $counter, $method \n";
            if ($assert) {
                return $assert($method, $params, $default);
            }
            $this->fail("Unexpected {$method} on index {$counter}.");
        });
    }

    private function tearDownStack(): void
    {
        if (!empty($this->stack_items)) {
            $count = count($this->stack_items);
            $this->fail("Expected {$count} more asserts on stack.");
        }
    }

    private function pushStack(callable $callable): StackItem
    {
        $item = new StackItem($callable);
        $this->stack_items[] = $item;
        return $item;
    }
}
