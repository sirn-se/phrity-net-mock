<?php

/**
 * File for Net\Mock\EchoLogger class.
 * @package Phrity > Net > Mock > EchoLogger
 */

namespace Phrity\Net\Mock;

use Psr\Log\{
    LoggerInterface,
    LoggerTrait,
    NullLogger
};
use Stringable;

/**
 * Phrity\Net\Mock\EchoLogger class.
 */
class EchoLogger implements LoggerInterface
{
    use LoggerTrait;

    public function log($level, Stringable|string $message, array $context = []): void
    {
        $context = $this->stringify($context);
        $message = $this->interpolate($message, $context);
        echo "[{$level}] {$message} {$this->format($context)}\n";
    }

    /**
     * @param array<string, mixed> $context
     */
    private function format(array $context): string
    {
        return json_encode($context, JSON_FORCE_OBJECT) ?: '';
    }

    /**
     * @param array<string, mixed> $context
     * @return array<string, mixed>
     */
    private function stringify(array $context): array
    {
        return array_map(function ($item) {
            if (is_scalar($item)) {
                return $item;
            }
            if (is_object($item)) {
                return get_class($item);
            }
            return gettype($item);
        }, $context);
    }

    /**
     * @param array<string, mixed> $context
     */
    private function interpolate(string $message, array $context = []): string
    {
        $replace = [];
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }
        return strtr($message, $replace);
    }
}
