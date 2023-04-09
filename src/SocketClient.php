<?php

namespace Phrity\Net\Mock;

use Phrity\Net\SocketClient as NetSocketClient;
use Psr\Http\Message\UriInterface;

/**
 * Phrity\Net\Mock\SocketClient class.
 */
class SocketClient extends NetSocketClient
{
    use MockTrait;

    /**
     * Create new socker server instance
     * \Psr\Http\Message\UriInterface $uri The URI to open socket on.
     * int $flags Flags to set on socket.
     * @throws \RuntimeException if unable to create socket.
     */
    public function __construct(UriInterface $uri)
    {
        $this->mockHandle();
    }

    /**
     * Create a connection on remote socket.
     * @return \Psr\Http\Message\StreamInterface|null The stream for opened conenction.
     * @throws \RuntimeException if connection could not be created
     */
    public function connect(): ?SocketStream
    {
        return $this->mockHandle(function () {
            $mock_stream = fopen('php://temp', 'r');
            return new SocketStream($mock_stream);
        });
    }

    public function setPersistent(bool $persistent): self
    {
        return $this->mockHandle();
    }

    public function setTimeout(?int $timeout): self
    {
        return $this->mockHandle();
    }

    public function setContext($context): self
    {
        return $this->mockHandle();
    }
}
