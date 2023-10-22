<?php

declare(strict_types=1);

namespace Phrity\Net\Mock\Test;

use PHPUnit\Framework\TestCase;
use Phrity\Net\Mock\{
    Mock,
    SocketClient,
    SocketServer,
    SocketStream,
    StreamCollection,
    StreamFactory,
    Stream
};
use Phrity\Net\Mock\Stack\{
    ExpectSocketClientTrait,
    ExpectSocketServerTrait,
    ExpectSocketStreamTrait,
    ExpectStreamCollectionTrait,
    ExpectStreamFactoryTrait,
    ExpectStreamTrait,
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
    use ExpectStreamCollectionTrait;
    use ExpectStreamFactoryTrait;
    use ExpectStreamTrait;

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

        $item = $this->expectSocketServerIsWritable();
        $this->assertInstanceOf(StackItem::class, $item);
        $server->isWritable();

        $item = $this->expectSocketServerIsReadable();
        $this->assertInstanceOf(StackItem::class, $item);
        $server->isReadable();

        $item = $this->expectSocketServerAccept();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketStream();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketStreamGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $server->accept(10);

        $item = $this->expectSocketServerClose();
        $this->assertInstanceOf(StackItem::class, $item);
        $server->close();
    }

    public function testtStream(): void
    {
        $file = __DIR__ . '/fixtures/stream.txt';
        $resource = fopen($file, 'r+');

        $item = $this->expectStream();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectStreamGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream = new Stream($resource);

        $item = $this->expectStreamWrite();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->write('hello');

        $item = $this->expectStreamRead();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->read(5);

        $item = $this->expectStreamTell();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->tell();

        $item = $this->expectStreamEof();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->eof();

        $item = $this->expectStreamClose();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->close();

        $item = $this->expectStreamIsReadable();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->isReadable();

        $item = $this->expectStreamIsWritable();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream->isWritable();
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

        $item = $this->expectStreamFactoryCreateSocketClient();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketClient();
        $this->assertInstanceOf(StackItem::class, $item);
        $factory->createSocketClient(new Uri('tcp://127.0.0.1'));

        $item = $this->expectStreamFactoryCreateSocketServer();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketServer();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketServerGetTransports();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketServerGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $factory->createSocketServer(new Uri('tcp://0.0.0.0:8000'));

        $item = $this->expectStreamFactoryCreateStream();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectStreamFactoryCreateStreamFromResource();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectStream();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectStreamGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $factory->createStream();

        $item = $this->expectStreamFactoryCreateStreamFromFile();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectStreamFactoryCreateStreamFromResource();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectStream();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectStreamGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $factory->createStreamFromFile(__DIR__ . '/fixtures/stream.txt');

        $file = __DIR__ . '/fixtures/stream.txt';
        $resource = fopen($file, 'r+');
        $item = $this->expectStreamFactoryCreateSocketStreamFromResource();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketStream();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectSocketStreamGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $factory->createSocketStreamFromResource($resource);

        $item = $this->expectStreamFactoryCreateStreamCollection();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectStreamCollection();
        $this->assertInstanceOf(StackItem::class, $item);
        $factory->createStreamCollection();
    }

    public function testStreamCollection(): void
    {
        $item = $this->expectStreamCollection();
        $this->assertInstanceOf(StackItem::class, $item);
        $collection = new StreamCollection();

        $file = __DIR__ . '/fixtures/stream.txt';
        $resource = fopen($file, 'r+');

        $item = $this->expectStream();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectStreamGetMetadata();
        $this->assertInstanceOf(StackItem::class, $item);
        $stream = new Stream($resource);

        $item = $this->expectStreamCollectionAttach();
        $this->assertInstanceOf(StackItem::class, $item);
        $collection->attach($stream);

        $item = $this->expectStreamCollectionGetReadable();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectStreamIsReadable();
        $this->assertInstanceOf(StackItem::class, $item);
        $collection->getReadable();

        $item = $this->expectStreamCollectionWaitRead();
        $this->assertInstanceOf(StackItem::class, $item);
        $item = $this->expectStreamCollection();
        $this->assertInstanceOf(StackItem::class, $item);
        $collection->waitRead();

        $item = $this->expectStreamCollectionDetach();
        $this->assertInstanceOf(StackItem::class, $item);
        $collection->detach($stream);
    }

    public function testReturn(): void
    {
        $this->expectStreamFactory();
        $factory = new StreamFactory();

        $this->expectStreamFactoryCreateSocketClient()->setReturn(function () {
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
