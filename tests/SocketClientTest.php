<?php

declare(strict_types=1);

namespace Phrity\Net\Mock\Test;

use PHPUnit\Framework\TestCase;
use Phrity\Net\Mock\{
    Mock,
    SocketClient,
};
use Phrity\Net\Uri;
use Psr\Http\Message\{
    StreamFactoryInterface,
    StreamInterface
};

/**
 * Phrity\Net\Mock\Test\SocketClientTest test class.
 */
class SocketClientTest extends TestCase
{
    public function testSocketClient(): void
    {
        Mock::setCallback(function ($counter, $method, $params, $default) {
            switch ($counter) {
                case 0:
                    $this->assertEquals('SocketClient.__construct', $method);
                    $this->assertInstanceOf(Uri::class, $params[0]);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 1:
                    $this->assertEquals('SocketClient.setPersistent', $method);
                    $this->assertEquals([true], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 2:
                    $this->assertEquals('SocketClient.setTimeout', $method);
                    $this->assertEquals([10], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 3:
                    $this->assertEquals('SocketClient.setContext', $method);
                    $this->assertEquals([['test' => []]], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 4:
                    $this->assertEquals('SocketClient.connect', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
            }
        });

        $uri = new Uri('tcp://0.0.0.0:8000');
        $client = new SocketClient($uri);
        $this->assertInstanceOf(SocketClient::class, $client);
        $client->setPersistent(true);
        $client->setTimeout(10);
        $client->setContext(['test' => []]);
        $stream = $client->connect();
        $this->assertInstanceOf(StreamInterface::class, $stream);
    }
}
