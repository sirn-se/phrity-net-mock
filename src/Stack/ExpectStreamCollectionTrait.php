<?php

namespace Phrity\Net\Mock\Stack;

use Phrity\Net\StreamInterface;

/**
 * Expect methods for StreamCollection.
 */
trait ExpectStreamCollectionTrait
{
    use StackTrait;

    private function expectStreamCollection(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamCollection.__construct', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectStreamCollectionAttach(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamCollection.attach', $method);
            $this->assertCountRange(1, 2, $params);
            $this->assertInstanceOf(StreamInterface::class, $params[0]);
        });
    }

    private function expectStreamCollectionDetach(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamCollection.detach', $method);
            $this->assertCount(1, $params);
        });
    }

    private function expectStreamCollectionGetReadable(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamCollection.getReadable', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectStreamCollectionWaitRead(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamCollection.waitRead', $method);
            $this->assertCountRange(0, 1, $params);
        });
    }

    private function expectStreamCollectionCount(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamCollection.count', $method);
            $this->assertEmpty($params);
        });
    }
}
