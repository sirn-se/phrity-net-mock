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

    // ---------- Configuration ---------------------------------------------------------------------------------------

    /**
     * Set stream context.
     * @param array|null $options
     * @param array|null $params
     * @return \Phrity\Net\SocketClient
     */
    public function setContext(?array $options = null, ?array $params = null): self
    {
        return $this->mockHandle();
    }

    /**
     * Set connection persistency.
     * @param bool $persistent
     * @return \Phrity\Net\SocketClient
     */
    public function setPersistent(bool $persistent): self
    {
        return $this->mockHandle();
    }

    /**
     * Set timeout in seconds.
     * @param int|null $timeout
     * @return \Phrity\Net\SocketClient
     */
    public function setTimeout(?int $timeout): self
    {
        return $this->mockHandle();
    }


    // ---------- Operations ------------------------------------------------------------------------------------------

    /**
     * Create a connection on remote socket.
     * @return \Phrity\Net\SocketStream The stream for opened conenction.
     * @throws StreamException if connection could not be created
     */
    public function connect(): SocketStream
    {
        return $this->mockHandle(function () {
            $mock_stream = fopen('php://temp', 'rw');
            return new SocketStream($mock_stream);
        });
    }
}
