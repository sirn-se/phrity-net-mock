<?php

namespace Phrity\Net\Mock;

use Phrity\Net\SocketServer as NetSocketServer;
use Psr\Http\Message\UriInterface;

/**
 * Phrity\Net\Mock\SocketServer class.
 */
class SocketServer extends NetSocketServer
{
    use MockTrait;

    /**
     * Create new mock socker server instance
     * Psr\Http\Message\UriInterface $uri The URI to open socket on.
     * int $flags Flags to set on socket.
     */
    public function __construct(UriInterface $uri, int $flags = STREAM_SERVER_BIND | STREAM_SERVER_LISTEN)
    {
        $this->mockHandle();
    }

    /**
     * Automatically close on destruct.
     */
    public function __destruct()
    {
    }


    // ---------- PSR-7 methods ---------------------------------------------------------------------------------------

    /**
     * Close this server socket.
     */
    public function close(): void
    {
        $this->mockHandle();
    }

    /**
     * Get stream metadata as an associative array or retrieve a specific key.
     * @param string $key Specific metadata to retrieve.
     * @return array|mixed|null Returns an associative array if no key is
     *     provided. Returns a specific key value if a key is provided and the
     *     value is found, or null if the key is not found.
     */
    public function getMetadata($key = null)
    {
        return $this->mockHandle();
    }


    // ---------- Configuration ---------------------------------------------------------------------------------------

    /**
     * Retrieve list of registered socket transports.
     * @return array List of registered transports.
     */
    public function getTransports(): array
    {
        return $this->mockHandle();
    }

    /**
     * If server is in blocking mode.
     * @return bool|null
     */
    public function isBlocking(): ?bool
    {
        return $this->mockHandle();
    }

    /**
     * Toggle blocking/non-blocking mode.
     * @param bool $enable Blocking mode to set.
     * @return bool If operation was succesful.
     */
    public function setBlocking(bool $enable): bool
    {
        return $this->mockHandle();
    }


    // ---------- Operations ------------------------------------------------------------------------------------------

    /**
     * Accept a connection on a socket.
     * @param int|null $timeout Override the default socket accept timeout.
     * @return Psr\Http\Message\StreamInterface|null The stream for opened conenction.
     */
    public function accept(?int $timeout = null): ?SocketStream
    {
        return $this->mockHandle(function () {
            $mock_stream = fopen('php://temp', 'r');
            return new SocketStream($mock_stream);
        });
    }
}
