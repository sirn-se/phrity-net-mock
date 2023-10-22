<?php

namespace Phrity\Net\Mock\Stack;

/**
 * PhpUnit test methods for Stream.
 */
trait ExpectStreamTrait
{
    use StackTrait;

    private function expectStream(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Stream.__construct', $method);
            $this->assertCount(1, $params);
            $this->assertIsResource($params[0]);
        });
    }

    private function expectStreamGetMetadata(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Stream.getMetadata', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectStreamIsWritable(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Stream.isWritable', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectStreamIsReadable(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Stream.isReadable', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectStreamClose(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Stream.close', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectStreamWrite(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Stream.write', $method);
            $this->assertCount(1, $params);
            $this->assertIsString($params[0]);
        });
    }

    private function expectStreamRead(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Stream.read', $method);
            $this->assertCount(1, $params);
            $this->assertIsInt($params[0]);
        });
    }

    private function expectStreamTell(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Stream.tell', $method);
            $this->assertEmpty($params);
        });
    }

    private function expectStreamEof(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('Stream.eof', $method);
            $this->assertEmpty($params);
        });
    }
}
