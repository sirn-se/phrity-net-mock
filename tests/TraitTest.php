<?php

declare(strict_types=1);

namespace Phrity\Net\Mock\Test;

use PHPUnit\Framework\TestCase;
use Phrity\Net\Mock\{
    Mock,
    SocketClient,
    SocketServer,
    SocketStream,
    StreamFactory
};
use Phrity\Net\Mock\Stack\{
    ExpectSocketClientTrait,
    ExpectSocketServerTrait,
    ExpectSocketStreamTrait,
    ExpectStreamFactoryTrait,
    StackItem,
};
use Phrity\Net\Uri;
use Psr\Http\Message\{
    StreamFactoryInterface,
    StreamInterface
};

/**
 * Phrity\Net\Mock\Test\TraitTest test class.
 */
class TraitTest extends TestCase
{
    use ExpectSocketClientTrait;
    use ExpectSocketServerTrait;
    use ExpectSocketStreamTrait;
    use ExpectStreamFactoryTrait;

    public function setUp(): void
    {
        $this->setUpStack();
    }

    public function tearDown(): void
    {
        $this->tearDownStack();
    }

    public function testSocketClient(): void
    {
        $item = $this->expectSocketClient();
        $this->assertInstanceOf(StackItem::class, $item);
        $client = new SocketClient(new Uri('tcp://127.0.0.1'));

        $item = $this->expectSocketClientSetContext();
        $this->assertInstanceOf(StackItem::class, $item);
        $client->setContext([]);

        $item = $this->expectSocketClientSetPersistent();
        $this->assertInstanceOf(StackItem::class, $item);
        $client->setPersistent(true);

        $item = $this->expectSocketClientSetTimeout();
        $this->assertInstanceOf(StackItem::class, $item);
        $client->setTimeout(10);

        $item = $this->expectSocketClientConnect();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketStream();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketStreamGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $client->connect();
    }

    public function testSocketServer(): void
    {
        $item = $this->expectSocketServer();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketServerGetTransports();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketServerGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $server = new SocketServer(new Uri('tcp://0.0.0.0:8000'));

        $item = $this->expectSocketServerIsBlocking();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketServerGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $server->isBlocking();

        $item = $this->expectSocketServerSetBlocking();
        $this->assertInstanceOf(StackItem::class, $item);
        $server->setBlocking(true);

        $item = $this->expectSocketServerAccept();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketStream();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketStreamGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $server->accept(10);
    }

    public function testSocketStream(): void
    {
        $file = __DIR__ . '/fixtures/stream.txt';
        $resource = fopen($file, 'r+');

        $item = $this->expectSocketStream();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketStreamGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream = new SocketStream($resource);

        $item = $this->expectSocketStreamGetLocalName();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->getLocalName();

        $item = $this->expectSocketStreamGetRemoteName();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->getRemoteName();

        $item = $this->expectSocketStreamGetResourceType();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->getResourceType();

        $item = $this->expectSocketStreamIsConnected();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->isConnected();

        $item = $this->expectSocketStreamSetTimeout();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->setTimeout(10);

        $item = $this->expectSocketStreamWrite();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->write('hello');

        $item = $this->expectSocketStreamRead();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->read(5);

        $item = $this->expectSocketStreamReadLine();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->readLine(5);

        $item = $this->expectSocketStreamTell();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->tell();

        $item = $this->expectSocketStreamEof();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->eof();

        $item = $this->expectSocketStreamCloseRead();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketStreamGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->closeRead();

        $item = $this->expectSocketStreamCloseWrite();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketStreamClose();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->closeWrite();

        $item = $this->expectSocketStreamClose();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->close();

        $item = $this->expectSocketStreamIsReadable();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->isReadable();

        $item = $this->expectSocketStreamIsWritable();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->isWritable();
    }

    public function testStreamFactory(): void
    {
        $item = $this->expectStreamFactory();
        $this->assertInstanceOf(StackItem::class, $item);
        $factory = new StreamFactory();

        $item = $this->expectStreamFactoryCreateSockerClient();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketClient();
        $this->assertInstanceOf(StackItem::class, $item);
        $factory->createSocketClient(new Uri('tcp://127.0.0.1'));

        $item = $this->expectStreamFactoryCreateSockerServer();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketServer();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketServerGetTransports();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketServerGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $factory->createSocketServer(new Uri('tcp://0.0.0.0:8000'));
    }

    public function testReturn(): void
    {
        $this->expectStreamFactory();
        $factory = new StreamFactory();

        $this->expectStreamFactoryCreateSockerClient()->setReturn(function () {
            return new SocketClient(new Uri('ssl://127.0.0.1'));
        });
        $this->expectSocketClient();
        $factory->createSocketClient(new Uri('tcp://127.0.0.1'));
    }

    public function testUnexpectedError(): void
    {
        // This should cause assertion error
        $this->expectException('PHPUnit\Framework\AssertionFailedError');
        $factory = new StreamFactory();
    }

    public function testExpectedError(): void
    {
        // This should cause assertion error (this is tricky to test)
        $this->stack_items[] = 1;
        try {
            $this->tearDownStack();
        } catch (\PHPUnit\Framework\AssertionFailedError $e) {
            $this->stack_items = [];
            return;
        }
        $this->fail('Expected items on stack did not fail');
    }
}
