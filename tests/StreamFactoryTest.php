<?php

declare(strict_types=1);

namespace Phrity\Net\Mock\Test;

use PHPUnit\Framework\TestCase;
use Phrity\Net\Mock\{
    Mock,
    SocketClient,
    SocketServer,
    SocketStream,
    Stream,
    StreamFactory,
};
use Phrity\Net\Uri;
use Psr\Http\Message\{
    StreamFactoryInterface,
    StreamInterface
};

/**
 * Phrity\Net\Mock\Test\StreamFactoryTest test class.
 */
class StreamFactoryTest extends TestCase
{
    public function testFactory(): void
    {
        Mock::setCallback(function ($counter, $method, $params, $default) {
            $this->assertEquals(0, $counter);
            $this->assertEquals('StreamFactory.__construct', $method);
            $this->assertEquals([], $params);
            $this->assertIsCallable($default);
            $default($params);
        });
        $factory = new StreamFactory();
        $this->assertInstanceOf(StreamFactoryInterface::class, $factory);
        $this->assertInstanceOf(StreamFactory::class, $factory);
    }

    public function testCreateStream(): void
    {
        Mock::setCallback(function ($counter, $method, $params, $default) {
            switch ($counter) {
                case 0:
                    $this->assertEquals('StreamFactory.__construct', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 1:
                    $this->assertEquals('StreamFactory.createStream', $method);
                    $this->assertEquals(['Test creating stream'], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 2:
                    $this->assertEquals('StreamFactory.createStreamFromResource', $method);
                    $this->assertIsResource($params[0]);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 3:
                    $this->assertEquals('Stream.__construct', $method);
                    $this->assertIsResource($params[0]);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
            }
        });
        $factory = new StreamFactory();
        $stream = $factory->createStream('Test creating stream');
        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertInstanceOf(Stream::class, $stream);
    }

    public function testCreateStreamFromFile(): void
    {
        $file = __DIR__ . '/fixtures/stream.txt';
        Mock::setCallback(function ($counter, $method, $params, $default) use ($file) {
            switch ($counter) {
                case 0:
                    $this->assertEquals('StreamFactory.__construct', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 1:
                    $this->assertEquals('StreamFactory.createStreamFromFile', $method);
                    $this->assertEquals([$file, 'r+'], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 2:
                    $this->assertEquals('StreamFactory.createStreamFromResource', $method);
                    $this->assertIsResource($params[0]);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 3:
                    $this->assertEquals('Stream.__construct', $method);
                    $this->assertIsResource($params[0]);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
            }
        });
        $factory = new StreamFactory();
        $stream = $factory->createStreamFromFile($file, 'r+');
        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertInstanceOf(Stream::class, $stream);
    }

    public function testCreateSocketStream(): void
    {
        Mock::setCallback(function ($counter, $method, $params, $default) {
            switch ($counter) {
                case 0:
                    $this->assertEquals('StreamFactory.__construct', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 1:
                    $this->assertEquals('StreamFactory.createSocketStreamFromResource', $method);
                    $this->assertIsResource($params[0]);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 2:
                    $this->assertEquals('SocketStream.__construct', $method);
                    $this->assertIsResource($params[0]);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
            }
        });
        $file = __DIR__ . '/fixtures/stream.txt';
        $resource = fopen($file, 'r+');
        $factory = new StreamFactory();
        $stream = $factory->createSocketStreamFromResource($resource);
        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertInstanceOf(SocketStream::class, $stream);
    }

    public function testCreateSocketServer(): void
    {
        Mock::setCallback(function ($counter, $method, $params, $default) {
            switch ($counter) {
                case 0:
                    $this->assertEquals('StreamFactory.__construct', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 1:
                    $this->assertEquals('StreamFactory.createSocketServer', $method);
                    $this->assertInstanceOf(Uri::class, $params[0]);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 2:
                    $this->assertEquals('SocketServer.__construct', $method);
                    $this->assertInstanceOf(Uri::class, $params[0]);
                    $this->assertIsCallable($default);
                    break;
            }
        });
        $uri = new Uri('tcp://localhost:80');
        $factory = new StreamFactory();
        $stream = $factory->createSocketServer($uri);
        $this->assertInstanceOf(SocketServer::class, $stream);
    }
}
