<?php

namespace Phrity\Net\Mock\Stack;

/**
 * PhpUnit test methods for StreamCollection.
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
            $this->assertInstanceOf('Phrity\Net\Stream', $params[0]);
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

    private function expectStreamCollectionRewind(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamCollection.rewind', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectStreamCollectionValid(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamCollection.valid', $method);
            $this->assertEmpty($params);
        });
    }
}
