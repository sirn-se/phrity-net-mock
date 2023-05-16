<?php

namespace Phrity\Net\Mock\Stack;

/**
 * PhpUnit test methods for SocketServer.
 */
trait ExpectSocketServerTrait
{
    use StackTrait;

    private function expectSocketServer(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketServer.__construct', $method);
            $this->assertGreaterThanOrEqual(1, count($params));
            $this->assertLessThanOrEqual(2, count($params));
            $this->assertInstanceOf('Psr\Http\Message\UriInterface', $params[0]);
        });
    }

    private function expectSocketServerGetTransports(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketServer.getTransports', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectSocketServerIsBlocking(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketServer.isBlocking', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectSocketServerSetBlocking(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketServer.setBlocking', $method);
            $this->assertCount(1, $params);
            $this->assertIsBool($params[0]);
        });
    }

    private function expectSocketServerAccept(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketServer.accept', $method);
            $this->assertCount(1, $params);
            $this->assertIsInt($params[0]);
        });
    }

    private function expectSocketServerGetMetadata(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketServer.getMetadata', $method);
            $this->assertGreaterThanOrEqual(0, count($params));
            $this->assertLessThanOrEqual(1, count($params));
        });
    }
}
