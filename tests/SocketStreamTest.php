<?php

declare(strict_types=1);

namespace Phrity\Net\Mock\Test;

use PHPUnit\Framework\TestCase;
use Phrity\Net\Mock\{
    Context,
    Mock,
    SocketStream,
};
use Psr\Http\Message\{
    StreamFactoryInterface,
    StreamInterface
};

/**
 * Phrity\Net\Mock\Test\SocketStreamTest test class.
 */
class SocketStreamTest extends TestCase
{
    public function testSocketStream(): void
    {
        Mock::setCallback(function ($counter, $method, $params, $default) {
            switch ($counter) {
                case 0:
                    $this->assertEquals('SocketStream.__construct', $method);
                    $this->assertIsResource($params[0]);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 1:
                    $this->assertEquals('SocketStream.getMetadata', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 2:
                    $this->assertEquals('Context.__construct', $method);
                    $this->assertIsResource($params[0]);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 3:
                    $this->assertEquals('SocketStream.getRemoteName', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return 'name';
                case 4:
                    $this->assertEquals('SocketStream.isBlocking', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return false;
                case 5:
                    $this->assertEquals('SocketStream.setBlocking', $method);
                    $this->assertEquals([true], $params);
                    $this->assertIsCallable($default);
                    return true;
                case 6:
                    $this->assertEquals('SocketStream.getLocalName', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return 'name';
                case 7:
                    $this->assertEquals('SocketStream.getResourceType', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return 'stream';
                case 8:
                    $this->assertEquals('SocketStream.setTimeout', $method);
                    $this->assertEquals([10], $params);
                    $this->assertIsCallable($default);
                    return true;
                case 9:
                    $this->assertEquals('SocketStream.readLine', $method);
                    $this->assertEquals([10], $params);
                    $this->assertIsCallable($default);
                    return 'abcdefghij';
                case 10:
                    $this->assertEquals('SocketStream.isConnected', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return true;
                case 11:
                    $this->assertEquals('SocketStream.getContext', $method);
                    $this->assertEmpty($params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 12:
                    $this->assertEquals('SocketStream.closeRead', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    break;
                case 13:
                    $this->assertEquals('SocketStream.closeWrite', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    break;
            }
        });

        $file = __DIR__ . '/fixtures/stream.txt';
        $resource = fopen($file, 'r+');

        $stream = new SocketStream($resource);
        $this->assertEquals('name', $stream->getRemoteName());
        $this->assertFalse($stream->isBlocking());
        $this->assertTrue($stream->setBlocking(true));
        $this->assertEquals('name', $stream->getLocalName());
        $this->assertEquals('stream', $stream->getResourceType());
        $this->assertTrue($stream->setTimeout(10));
        $this->assertEquals('abcdefghij', $stream->readLine(10));
        $this->assertTrue($stream->isConnected());
        $context = $stream->getContext();
        $this->assertInstanceOf(Context::class, $context);
        $stream->closeRead();
        $stream->closeWrite();
    }
}
