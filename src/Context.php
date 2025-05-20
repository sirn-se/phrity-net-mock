<?php

namespace Phrity\Net\Mock;

use Closure;
use Phrity\Net\Context as NetContext;

/**
 * Context class.
 */
class Context extends NetContext
{
    use MockTrait;

    /**
     * @param open-resource|null $stream
     */
    public function __construct(mixed $stream = null)
    {
        $this->mockHandle(function () use ($stream) {
            parent::__construct($stream);
        });
    }

    public function getOption(string $wrapper, string $option): mixed
    {
        return $this->mockHandle();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function getOptions(): array
    {
        return $this->mockHandle();
    }

    public function setOption(string $wrapper, string $option, mixed $value): self
    {
        return $this->mockHandle();
    }

    /**
     * @param array<string, array<string, mixed>> $options
     */
    public function setOptions(array $options): self
    {
        return $this->mockHandle();
    }

    public function getParam(string $param): mixed
    {
        return $this->mockHandle();
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return $this->mockHandle();
    }

    public function setParam(string $param, mixed $value): self
    {
        return $this->mockHandle();
    }

    /**
     * @param array<string, mixed> $params
     */
    public function setParams(array $params): self
    {
        return $this->mockHandle();
    }

    public function getResource(): mixed
    {
        return $this->mockHandle();
    }

    /** @param Closure(): void $closure */
    public function onResolve(Closure $closure): void
    {
        $this->mockHandle();
    }

    /** @param Closure(): void $closure */
    public function onConnect(Closure $closure): void
    {
        $this->mockHandle();
    }

    /** @param Closure(): void $closure */
    public function onAuthRequired(Closure $closure): void
    {
        $this->mockHandle();
    }

    /** @param Closure(string $mimeType): void $closure */
    public function onMimeType(Closure $closure): void
    {
        $this->mockHandle();
    }

    /** @param Closure(int $fileSize): void $closure */
    public function onFileSize(Closure $closure): void
    {
        $this->mockHandle();
    }

    /** @param Closure(string $uri): void $closure */
    public function onRedirected(Closure $closure): void
    {
        $this->mockHandle();
    }

    /** @param Closure(int $transferred, int $max): void $closure */
    public function onProgress(Closure $closure): void
    {
        $this->mockHandle();
    }

    /** @param Closure(): void $closure */
    public function onCompleted(Closure $closure): void
    {
        $this->mockHandle();
    }

    /** @param Closure(string $message, int $code): void $closure */
    public function onFailure(Closure $closure): void
    {
        $this->mockHandle();
    }

    /** @param Closure(): void $closure */
    public function onAuthResult(Closure $closure): void
    {
        $this->mockHandle();
    }
}
