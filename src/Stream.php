<?php

namespace Phrity\Net\Mock;

use Phrity\Net\Stream as NetStream;
use Psr\Http\Message\StreamInterface;

/**
 * Phrity\Net\Mock\Stream class.
 */
class Stream extends NetStream
{
    use MockTrait;

    /**
     * Create new stream wrapper instance
     * @param resource $resource A stream resource to wrap
     */
    public function __construct($stream)
    {
        $this->mockHandle();
    }


    // ---------- PSR-7 methods ---------------------------------------------------------------------------------------

    /**
     * Closes the stream and any underlying resources.
     * @return void
     */
    public function close(): void
    {
        $this->mockHandle();
    }

    /**
     * Separates any underlying resources from the stream.
     * After the stream has been detached, the stream is in an unusable state.
     * @return resource|null Underlying stream, if any
     */
    public function detach()
    {
        return $this->mockHandle();
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

    /**
     * Returns the current position of the file read/write pointer
     * @return int Position of the file pointer
     */
    public function tell(): int
    {
        return $this->mockHandle();
    }

    /**
     * Returns true if the stream is at the end of the stream.
     * @return bool
     */
    public function eof(): bool
    {
        return $this->mockHandle();
    }

    /**
     * Read data from the stream.
     * @param int $length Read up to $length bytes from the object and return them.
     * @return string Returns the data read from the stream, or an empty string.
     */
    public function read($length): string
    {
        return $this->mockHandle();
    }

    /**
     * Write data to the stream.
     * @param string $string The string that is to be written.
     * @return int Returns the number of bytes written to the stream.
     */
    public function write($string): int
    {
        return $this->mockHandle();
    }

    /**
     * Get the size of the stream if known.
     * @return int|null Returns the size in bytes if known, or null if unknown.
     */
    public function getSize(): ?int
    {
        return $this->mockHandle();
    }

    /**
     * Returns whether or not the stream is seekable.
     * @return bool
     */
    public function isSeekable(): bool
    {
        return $this->mockHandle();
    }

    /**
     * Seek to a position in the stream.
     * @param int $offset Stream offset
     * @param int $whence Specifies how the cursor position will be calculated based on the seek offset.
     */
    public function seek($offset, $whence = SEEK_SET): void
    {
        $this->mockHandle();
    }

    /**
     * Seek to the beginning of the stream.
     * If the stream is not seekable, this method will raise an exception;
     * otherwise, it will perform a seek(0).
     */
    public function rewind(): void
    {
        $this->mockHandle();
    }

    /**
     * Returns whether or not the stream is writable.
     * @return bool
     */
    public function isWritable(): bool
    {
        return $this->mockHandle();
    }

    /**
     * Returns whether or not the stream is readable.
     * @return bool
     */
    public function isReadable(): bool
    {
        return $this->mockHandle();
    }

    /**
     * Returns the remaining contents in a string
     * @return string
     */
    public function getContents(): string
    {
        return $this->mockHandle();
    }

    /**
     * Reads all data from the stream into a string, from the beginning to end.
     * @return string
     */
    public function __toString(): string
    {
        return $this->mockHandle();
    }
}
