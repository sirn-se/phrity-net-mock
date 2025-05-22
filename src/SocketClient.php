<?php

namespace Phrity\Net\Mock;

use Phrity\Net\{
    Context as NetContext,
    SocketClient as NetSocketClient
};
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
    public function __construct(UriInterface $uri, NetContext|null $context = null)
    {
        $this->mockHandle(function () use ($uri, $context) {
            parent::__construct($uri, $context ?? new Context());
        });
    }

    // ---------- Configuration ---------------------------------------------------------------------------------------

    /**
     * Set stream context.
     * @param NetContext|array<string, array<string, mixed>>|null $options
     * @param array<string, mixed>|null $params
     * @return SocketClient
     */
    public function setContext(NetContext|array|null $options = null, array|null $params = null): self
    {
        return $this->mockHandle();
    }

    public function getContext(): NetContext
    {
        return $this->mockHandle();
    }

    /**
     * Set connection persistency.
     * @param bool $persistent
     * @return self
     */
    public function setPersistent(bool $persistent): self
    {
        return $this->mockHandle();
    }

    /**
     * Set timeout in seconds.
     * @param int<0, max>|float|null $timeout
     * @return self
     */
    public function setTimeout(int|float|null $timeout): self
    {
        return $this->mockHandle();
    }


    // ---------- Operations ------------------------------------------------------------------------------------------

    /**
     * Create a connection on remote socket.
     * @return SocketStream The stream for opened conenction.
     */
    public function connect(): SocketStream
    {
        return $this->mockHandle(function () {
            /** @var resource $mock_stream */
            $mock_stream = fopen('php://temp', 'rw');
            return new SocketStream($mock_stream);
        });
    }
}
