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

/**
 * Phrity\Net\Mock\EchoLogger class.
 */
class EchoLogger implements LoggerInterface
{
    use LoggerTrait;

    public function log($level, $message, array $context = []): void
    {
        $context = $this->stringify($context);
        $message = $this->interpolate($message, $context);
        echo "[{$level}] {$message} {$this->format($context)}\n";
    }

    private function format(array $context): string
    {
        return json_encode($context, JSON_FORCE_OBJECT);
    }

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

    private function interpolate(string $message, array $context = [])
    {
        $replace = [];
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }
        return strtr($message, $replace);
    }
}
