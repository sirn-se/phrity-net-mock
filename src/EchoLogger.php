<?php

/**
 * File for Net\Mock\EchoLogger class.
 * @package Phrity > Net > Mock > EchoLogger
 */

namespace Phrity\Net\Mock;

use Psr\Log\{
    LoggerInterface,
    NullLogger
};

/**
 * Phrity\Net\Mock\EchoLogger class.
 */
class EchoLogger implements LoggerInterface
{
    public function emergency($message, array $context = []): void
    {
        $this->log('emergency', $message, $context);
    }

    public function alert($message, array $context = []): void
    {
        $this->log('alert', $message, $context);
    }

    public function critical($message, array $context = []): void
    {
        $this->log('critical', $message, $context);
    }

    public function error($message, array $context = []): void
    {
        $this->log('error', $message, $context);
    }

    public function warning($message, array $context = []): void
    {
        $this->log('warning', $message, $context);
    }

    public function notice($message, array $context = []): void
    {
        $this->log('notice', $message, $context);
    }

    public function info($message, array $context = []): void
    {
        $this->log('info', $message, $context);
    }

    public function debug($message, array $context = []): void
    {
        $this->log('debug', $message, $context);
    }

    public function log($level, $message, array $context = []): void
    {
        echo "[{$level}] {$message} [{$this->stringify($context)}]\n";
    }

    private function stringify(array $context): string
    {
        return implode(', ', array_map(function ($item) {
            if (is_scalar($item)) {
                return json_encode($item);
            }
            if (is_object($item)) {
                return get_class($item);
            }
            return gettype($item);
        }, $context));
    }
}
