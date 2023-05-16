<?php

declare(strict_types=1);

namespace Phrity\Net\Mock\Test;

use PHPUnit\Framework\TestCase;
use Phrity\Net\Mock\{
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
    public function testStream(): void
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
                    $this->assertEquals('SocketStream.tell', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 3:
                    $this->assertEquals('SocketStream.eof', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 4:
                    $this->assertEquals('SocketStream.read', $method);
                    $this->assertEquals([4], $params);
                    $this->assertIsCallable($default);
                    return 'test';
                case 5:
                    $this->assertEquals('SocketStream.write', $method);
                    $this->assertEquals(['test'], $params);
                    $this->assertIsCallable($default);
                    return 4;
                case 6:
                    $this->assertEquals('SocketStream.getSize', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return 4;
                case 7:
                    $this->assertEquals('SocketStream.isSeekable', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 8:
                    $this->assertEquals('SocketStream.seek', $method);
                    $this->assertEquals([1], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 9:
                    $this->assertEquals('SocketStream.rewind', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 10:
                    $this->assertEquals('SocketStream.seek', $method);
                    $this->assertEquals([0], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 11:
                    $this->assertEquals('SocketStream.isWritable', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 12:
                    $this->assertEquals('SocketStream.isReadable', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 13:
                    $this->assertEquals('SocketStream.getContents', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return 'test';
                case 14:
                    $this->assertEquals('SocketStream.__toString', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return 'test';
                case 15:
                    $this->assertEquals('SocketStream.detach', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return;
                case 16:
                    $this->assertEquals('SocketStream.close', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return;
            }
        });

        $file = __DIR__ . '/fixtures/stream.txt';
        $resource = fopen($file, 'r+');

        $stream = new SocketStream($resource);
        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertInstanceOf(SocketStream::class, $stream);
        $this->assertEquals(0, $stream->tell());
        $this->assertFalse($stream->eof());
        $this->assertEquals('test', $stream->read(4));
        $this->assertEquals(4, $stream->write('test'));
        $this->assertEquals(4, $stream->getSize());
        $this->assertTrue($stream->isSeekable());
        $stream->seek(1);
        $stream->rewind();
        $this->assertTrue($stream->isWritable());
        $this->assertTrue($stream->isReadable());
        $this->assertEquals('test', $stream->getContents());
        $this->assertEquals('test', $stream->__toString());
        $stream->detach();
        $stream->close();
    }

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
                    $this->assertEquals('SocketStream.getRemoteName', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return 'name';
                case 3:
                    $this->assertEquals('SocketStream.isBlocking', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return false;
                case 4:
                    $this->assertEquals('SocketStream.setBlocking', $method);
                    $this->assertEquals([true], $params);
                    $this->assertIsCallable($default);
                    return true;
                case 5:
                    $this->assertEquals('SocketStream.getLocalName', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return 'name';
                case 6:
                    $this->assertEquals('SocketStream.getResourceType', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return 'stream';
                case 7:
                    $this->assertEquals('SocketStream.setTimeout', $method);
                    $this->assertEquals([10], $params);
                    $this->assertIsCallable($default);
                    return true;
                case 8:
                    $this->assertEquals('SocketStream.readLine', $method);
                    $this->assertEquals([10], $params);
                    $this->assertIsCallable($default);
                    return 'abcdefghij';
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
    }
}
