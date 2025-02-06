<?php

namespace Phrity\Net\Mock\Stack;

use Psr\Http\Message\UriInterface;

/**
 * Expect methods for SocketClient.
 */
trait ExpectSocketClientTrait
{
    use StackTrait;

    private function expectSocketClient(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketClient.__construct', $method);
            $this->assertGreaterThanOrEqual(1, count($params));
            $this->assertLessThanOrEqual(2, count($params));
            $this->assertInstanceOf(UriInterface::class, $params[0]);
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

    private function expectSocketClientGetContext(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketClient.getContext', $method);
            $this->assertEmpty($params);
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
