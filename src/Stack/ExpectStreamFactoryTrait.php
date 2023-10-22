<?php

namespace Phrity\Net\Mock\Stack;

/**
 * PhpUnit test methods for StreamFactory.
 */
trait ExpectStreamFactoryTrait
{
    use StackTrait;

    private function expectStreamFactory(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamFactory.__construct', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectStreamFactoryCreateStream(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamFactory.createStream', $method);
            $this->assertCountRange(0, 1, $params);
        });
    }

    private function expectStreamFactoryCreateStreamFromFile(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamFactory.createStreamFromFile', $method);
            $this->assertCountRange(1, 2, $params);
            $this->assertIsString($params[0]);
        });
    }

    private function expectStreamFactoryCreateStreamFromResource(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamFactory.createStreamFromResource', $method);
            $this->assertCount(1, $params);
            $this->assertIsResource($params[0]);
        });
    }

    private function expectStreamFactoryCreateSocketClient(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamFactory.createSocketClient', $method);
            $this->assertCount(1, $params);
            $this->assertInstanceOf('Psr\Http\Message\UriInterface', $params[0]);
        });
    }

    private function expectStreamFactoryCreateSocketServer(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamFactory.createSocketServer', $method);
            $this->assertCountRange(1, 2, $params);
            $this->assertInstanceOf('Psr\Http\Message\UriInterface', $params[0]);
        });
    }

    private function expectStreamFactoryCreateSocketStreamFromResource(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamFactory.createSocketStreamFromResource', $method);
            $this->assertCount(1, $params);
            $this->assertIsResource($params[0]);
        });
    }

    private function expectStreamFactoryCreateStreamCollection(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamFactory.createStreamCollection', $method);
            $this->assertEmpty($params);
        });
    }
}
