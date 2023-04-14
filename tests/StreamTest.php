<?php

declare(strict_types=1);

namespace Phrity\Net\Mock\Test;

use PHPUnit\Framework\TestCase;
use Phrity\Net\Mock\{
    Mock,
    Stream,
};
use Psr\Http\Message\{
    StreamFactoryInterface,
    StreamInterface
};

/**
 * Phrity\Net\Mock\Test\StreamTest test class.
 */
class StreamTest extends TestCase
{
    public function testStream(): void
    {
        Mock::setCallback(function ($counter, $method, $params, $default) {
            switch ($counter) {
                case 0:
                    $this->assertEquals('Stream.__construct', $method);
                    $this->assertIsResource($params[0]);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 1:
                    $this->assertEquals('Stream.getMetadata', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 2:
                    $this->assertEquals('Stream.tell', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 3:
                    $this->assertEquals('Stream.eof', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 4:
                    $this->assertEquals('Stream.read', $method);
                    $this->assertEquals([4], $params);
                    $this->assertIsCallable($default);
                    return 'test';
                case 5:
                    $this->assertEquals('Stream.write', $method);
                    $this->assertEquals(['test'], $params);
                    $this->assertIsCallable($default);
                    return 4;
                case 6:
                    $this->assertEquals('Stream.getSize', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return 4;
                case 7:
                    $this->assertEquals('Stream.isSeekable', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 8:
                    $this->assertEquals('Stream.seek', $method);
                    $this->assertEquals([1], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 9:
                    $this->assertEquals('Stream.rewind', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 10:
                    $this->assertEquals('Stream.seek', $method);
                    $this->assertEquals([0], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 11:
                    $this->assertEquals('Stream.isWritable', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 12:
                    $this->assertEquals('Stream.isReadable', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 13:
                    $this->assertEquals('Stream.getContents', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return 'test';
                case 14:
                    $this->assertEquals('Stream.__toString', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return 'test';
                case 15:
                    $this->assertEquals('Stream.detach', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return;
                case 16:
                    $this->assertEquals('Stream.close', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return;
            }
        });

        $file = __DIR__ . '/fixtures/stream.txt';
        $resource = fopen($file, 'r+');

        $stream = new Stream($resource);
        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertInstanceOf(Stream::class, $stream);
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
}
