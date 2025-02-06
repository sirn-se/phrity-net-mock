<?php

namespace Phrity\Net\Mock\Stack;

/**
 * Expect methods for Context.
 */
trait ExpectContextTrait
{
    use StackTrait;

    private function expectContext(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Context.__construct', $method);
            $this->assertGreaterThanOrEqual(0, count($params));
            $this->assertLessThanOrEqual(1, count($params));
        });
    }

    private function expectContextGetOption(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Context.getOption', $method);
            $this->assertCount(2, $params);
            $this->assertIsString($params[0]);
            $this->assertIsString($params[1]);
        });
    }

    private function expectContextGetOptions(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Context.getOptions', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectContextSetOption(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Context.setOption', $method);
            $this->assertCount(3, $params);
            $this->assertIsString($params[0]);
            $this->assertIsString($params[1]);
        });
    }

    private function expectContextSetOptions(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Context.setOptions', $method);
            $this->assertCount(1, $params);
            $this->assertIsArray($params[0]);
        });
    }

    private function expectContextGetParam(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Context.getParam', $method);
            $this->assertCount(1, $params);
            $this->assertIsString($params[0]);
        });
    }

    private function expectContextGetParams(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Context.getParams', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectContextSetParam(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Context.setParam', $method);
            $this->assertCount(2, $params);
            $this->assertIsString($params[0]);
        });
    }

    private function expectContextSetParams(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Context.setParams', $method);
            $this->assertCount(1, $params);
            $this->assertIsArray($params[0]);
        });
    }

    private function expectContextGetResource(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Context.getResource', $method);
            $this->assertEmpty($params);
        });
    }
}
