<?php

namespace Phrity\Net\Mock;

use Phrity\Net\{
    Stream as NetStream,
    StreamCollection as NetStreamCollection,
    StreamInterface,
    StreamContainerInterface,
};

/**
 * Phrity\Net\Mock\StreamCollection class.
 */
class StreamCollection extends NetStreamCollection
{
    use MockTrait;

    /**
     * Create new stream collection instance.
     */
    public function __construct()
    {
        $this->mockHandle();
    }


    // ---------- Collectors and selectors ----------------------------------------------------------------------------

    /**
     * Attach stream to collection.
     * @param StreamInterface|StreamContainerInterface $attach Stream to attach.
     * @param string|null $key Definable name of stream.
     * @return string Name of stream.
     */
    public function attach(StreamInterface|StreamContainerInterface $attach, string|null $key = null): string
    {
        return $this->mockHandle();
    }

    /**
     * Detach stream from collection.
     * @param StreamInterface|StreamContainerInterface|string $detach Stream or name of stream  to detach.
     * @return bool If a stream was detached.
     */
    public function detach(StreamInterface|StreamContainerInterface|string $detach): bool
    {
        return $this->mockHandle();
    }

    /**
     * Collect all readable streams into new collection.
     * @return self New collection instance.
     */
    public function getReadable(): NetStreamCollection
    {
        return $this->mockHandle();
    }

    /**
     * Collect all writable streams into new collection.
     * @return self New collection instance.
     */
    public function getWritable(): NetStreamCollection
    {
        return $this->mockHandle();
    }

    /**
     * Wait for redable content in stream collection.
     * @param int<0, max>|float $timeout Timeout in seconds.
     * @return self New collection instance.
     */
    public function waitRead(int|float $timeout = 60): NetStreamCollection
    {
        return $this->mockHandle(function ($params) {
            return new self();
        });
    }


    // ---------- Countable interface implementation ------------------------------------------------------------------

    /**
     * Count contained streams.
     * @return int Number of streams in collection.
     */
    public function count(): int
    {
        return $this->mockHandle();
    }
}
