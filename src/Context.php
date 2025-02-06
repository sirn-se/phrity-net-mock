<?php

namespace Phrity\Net\Mock;

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

    public function getOptions(): array
    {
        return $this->mockHandle();
    }

    public function setOption(string $wrapper, string $option, mixed $value): self
    {
        return $this->mockHandle();
    }

    public function setOptions(array $options): self
    {
        return $this->mockHandle();
    }

    public function getParam(string $param): mixed
    {
        return $this->mockHandle();
    }

    public function getParams(): array
    {
        return $this->mockHandle();
    }

    public function setParam(string $param, mixed $value): self
    {
        return $this->mockHandle();
    }

    public function setParams(array $params): self
    {
        return $this->mockHandle();
    }

    public function getResource(): mixed
    {
        return $this->mockHandle();
    }
}
