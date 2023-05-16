<?php

namespace Phrity\Net\Mock\Stack;

/**
 * PhpUnit test methods for SocketStream.
 */
trait ExpectSocketStreamTrait
{
    use StackTrait;

    private function expectSocketStream(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketStream.__construct', $method);
            $this->assertCount(1, $params);
            $this->assertIsResource($params[0]);
        });
    }

    private function expectSocketStreamGetMetadata(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketStream.getMetadata', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectSocketStreamGetLocalName(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketStream.getLocalName', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectSocketStreamGetRemoteName(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketStream.getRemoteName', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectSocketStreamGetResourceType(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketStream.getResourceType', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectSocketStreamSetTimeout(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketStream.setTimeout', $method);
            $this->assertGreaterThanOrEqual(1, count($params));
            $this->assertLessThanOrEqual(2, count($params));
            $this->assertIsInt($params[0]);
        });
    }

    private function expectSocketStreamClose(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketStream.close', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectSocketStreamWrite(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketStream.write', $method);
            $this->assertCount(1, $params);
            $this->assertIsString($params[0]);
        });
    }

    private function expectSocketStreamRead(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketStream.read', $method);
            $this->assertCount(1, $params);
            $this->assertIsInt($params[0]);
        });
    }

    private function expectSocketStreamReadLine(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketStream.readLine', $method);
            $this->assertCount(1, $params);
            $this->assertIsInt($params[0]);
        });
    }

    private function expectSocketStreamTell(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('SocketStream.tell', $method);
            $this->assertEmpty($params);
        });
    }
}
