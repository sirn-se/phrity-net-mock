<?php

namespace Phrity\Net\Mock\Stack;

/**
 * PhpUnit test methods for treamFactory.
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

    private function expectStreamFactoryCreateSockerClient(): StackItem
    {
        return $this->pushStack(function (string $method, array $params): void {
            $this->assertEquals('StreamFactory.createSocketClient', $method);
            $this->assertCount(1, $params);
            $this->assertInstanceOf('Psr\Http\Message\UriInterface', $params[0]);
        });
    }
}
