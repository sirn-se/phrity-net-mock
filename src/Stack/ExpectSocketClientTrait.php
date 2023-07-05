<?php

namespace Phrity\Net\Mock\Stack;

/**
 * PhpUnit test methods for SocketClient.
 */
trait ExpectSocketClientTrait
{
    use StackTrait;

    private function expectSocketClient(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketClient.__construct', $method);
            $this->assertCount(1, $params);
            $this->assertInstanceOf('Psr\Http\Message\UriInterface', $params[0]);
        });
    }

    private function expectSocketClientSetContext(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketClient.setContext', $method);
            $this->assertGreaterThanOrEqual(0, count($params));
            $this->assertLessThanOrEqual(2, count($params));
        });
    }

    private function expectSocketClientSetPersistent(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketClient.setPersistent', $method);
            $this->assertCount(1, $params);
            $this->assertIsBool($params[0]);
        });
    }

    private function expectSocketClientSetTimeout(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketClient.setTimeout', $method);
            $this->assertCount(1, $params);
        });
    }

    private function expectSocketClientConnect(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketClient.connect', $method);
            $this->assertEmpty($params);
        });
    }
}
