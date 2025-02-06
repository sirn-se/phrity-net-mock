<?php

declare(strict_types=1);

namespace Phrity\Net\Mock\Test;

use PHPUnit\Framework\TestCase;
use Phrity\Net\Mock\{
    Context,
    Mock,
    SocketServer,
};
use Phrity\Net\Uri;
use Psr\Http\Message\{
    StreamFactoryInterface,
    StreamInterface
};

/**
 * Phrity\Net\Mock\Test\SocketServerTest test class.
 */
class SocketServerTest extends TestCase
{
    public function testSocketServer(): void
    {
        Mock::setCallback(function ($counter, $method, $params, $default) {
            switch ($counter) {
                case 0:
                    $this->assertEquals('SocketServer.__construct', $method);
                    $this->assertInstanceOf(Uri::class, $params[0]);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 1:
                    $this->assertEquals('Context.__construct', $method);
                    $this->assertEmpty($params);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 2:
                    $this->assertEquals('SocketServer.getTransports', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return ['tcp'];
                case 3:
                    $this->assertEquals('Context.getResource', $method);
                    $this->assertEmpty($params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 4:
                    $this->assertEquals('SocketServer.getMetadata', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return [];
                case 5:
                    $this->assertEquals('SocketServer.getMetadata', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return [];
                case 6:
                    $this->assertEquals('SocketServer.isBlocking', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return false;
                case 7:
                    $this->assertEquals('SocketServer.setBlocking', $method);
                    $this->assertEquals([true], $params);
                    $this->assertIsCallable($default);
                    return true;
                case 8:
                    $this->assertEquals('SocketServer.isReadable', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return true;
                case 9:
                    $this->assertEquals('SocketServer.isWritable', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return true;
                case 10:
                    $this->assertEquals('SocketServer.getContext', $method);
                    $this->assertEmpty($params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 11:
                    $this->assertEquals('SocketServer.setContext', $method);
                    $this->assertInstanceOf(Context::class, $params[0]);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 12:
                    $this->assertEquals('SocketServer.accept', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 13:
                    $this->assertEquals('SocketStream.__construct', $method);
                    $this->assertIsResource($params[0]);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 14:
                    $this->assertEquals('SocketStream.getMetadata', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 15:
                    $this->assertEquals('Context.__construct', $method);
                    $this->assertIsResource($params[0]);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 16:
                    $this->assertEquals('SocketServer.close', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
            }
        });

        $uri = new Uri('tcp://0.0.0.0:8000');
        $server = new SocketServer($uri);
        $this->assertInstanceOf(SocketServer::class, $server);
        $this->assertisArray($server->getMetadata());
        $this->assertFalse($server->isBlocking());
        $this->assertTrue($server->setBlocking(true));
        $this->assertTrue($server->isReadable());
        $this->assertTrue($server->isWritable());
        $context = $server->getContext();
        $this->assertInstanceOf(Context::class, $context);
        $server->setContext($context);
        $stream = $server->accept();
        $server->close();
    }
}
