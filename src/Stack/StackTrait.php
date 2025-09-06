<?php

namespace Phrity\Net\Mock\Stack;

use Closure;
use Phrity\Net\Mock\Mock;

/**
 * Stack enabler trait..
 */
trait StackTrait
{
    /** @var array<StackItem> */
    private $stack_items = [];

    private function setUpStack(): void
    {
        $this->stack_items = [];
        Mock::setCallback(function (int $counter, string $method, array $params, Closure $default, $instance) {
            $assert = array_shift($this->stack_items);
//echo "  $counter $method \n";
            if ($assert) {
                return $assert($method, $params, $default, $instance);
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

    private function pushStack(Closure $callable): StackItem
    {
        $item = new StackItem($callable);
        $this->stack_items[] = $item;
        return $item;
    }

    /**
     * @param array<mixed> $actual
     */
    private function assertCountRange(int $gte, int $lte, array $actual): void
    {
        $count = count($actual);
        $this->assertGreaterThanOrEqual($gte, $count);
        $this->assertLessThanOrEqual($lte, $count);
    }
}
