<?php

namespace Phrity\Net\Mock;

use Psr\Http\Message\{
    StreamFactoryInterface,
    UriInterface
};
use Phrity\Net\{
    SocketClient as NetSocketClient,
    SocketServer as NetSocketServer,
    SocketStream as NetSocketStream,
    Stream as NetStream,
    StreamCollection as NetStreamCollection,
    StreamFactory as NetStreamFactory,
};

/**
 * Phrity\Net\Mock\StreamFactory class.
 */
class StreamFactory extends NetStreamFactory
{
    use MockTrait;

    /**
     * Create new stream wrapper instance.
     */
    public function __construct()
    {
        $this->mockHandle();
    }


    // ---------- PSR-17 methods --------------------------------------------------------------------------------------

    /**
     * Create a new stream from a string.
     * @param string $content String content with which to populate the stream.
     * @return \Phrity\Net\Stream A stream instance.
     */
    public function createStream(string $content = ''): NetStream
    {
        return $this->mockHandle();
    }

    /**
     * Create a stream from an existing file.
     * @param string $filename The filename or stream URI to use as basis of stream.
     * @param string $mode The mode with which to open the underlying filename/stream.
     */
    public function createStreamFromFile(string $filename, string $mode = 'r'): NetStream
    {
        return $this->mockHandle();
    }

    /**
     * Create a new stream from an existing resource.
     * The stream MUST be readable and may be writable.
     * @param resource $resource The PHP resource to use as the basis for the stream.
     * @return \Phrity\Net\Stream A stream instance.
     */
    public function createStreamFromResource($resource): NetStream
    {
        return $this->mockHandle(function ($params) {
            return new Stream(...$params);
        });
    }


    // ---------- Extensions ------------------------------------------------------------------------------------------

    /**
     * Create a new ocket stream from an existing resource.
     * The stream MUST be readable and may be writable.
     * @param resource $resource The PHP resource to use as the basis for the stream.
     * @return \Phrity\Net\SocketStream A socket stream instance.
     */
    public function createSocketStreamFromResource($resource): NetSocketStream
    {
        return $this->mockHandle(function ($params) {
            return new SocketStream(...$params);
        });
    }

    /**
     * Create a new socket server.
     * @param \Psr\Http\Message\UriInterface $uri The URI to create server on.
     * @param int $flags Flags to set on socket.
     * @return \Phrity\Net\SocketServer A socket server instance.
     */
    public function createSocketServer(
        UriInterface $uri,
        int $flags = STREAM_SERVER_BIND | STREAM_SERVER_LISTEN
    ): NetSocketServer {
        return $this->mockHandle(function ($params) {
            return new SocketServer(...$params);
        });
    }

    /**
     * Create a new socket client.
     * @param \Psr\Http\Message\UriInterface $uri The URI to connect to.
     * @return \Phrity\Net\SocketClient A socket client instance.
     */
    public function createSocketClient(UriInterface $uri): NetSocketClient
    {
        return $this->mockHandle(function ($params) {
            return new SocketClient(...$params);
        });
    }

    /**
     * Create a new stream collection.
     * @return \Phrity\Net\StreamCollection A stream collection.
     */
    public function createStreamCollection(): NetStreamCollection
    {
        return $this->mockHandle(function ($params) {
            return new StreamCollection(...$params);
        });
    }
}
