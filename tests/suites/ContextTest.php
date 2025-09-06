<?php

declare(strict_types=1);

namespace Phrity\Net\Mock\Test;

use PHPUnit\Framework\TestCase;
use Phrity\Net\Mock\Context;

class ContextTest extends TestCase
{
    public function testContext(): void
    {
        $context = new Context();
        $this->assertIsResource($context->getResource());
        $context->setParams(['notification' => 'trim']);
        $context->setParam('notification', 'trim');
        $this->assertEquals([
            'options' => [],
            'notification' => 'trim',
        ], $context->getParams());
        $this->assertEquals('trim', $context->getParam('notification'));

        $context->setOptions(['testo' => ['test1' => 'test-1']]);
        $context->setOption('testo', 'test2', 'test-2');
        $this->assertEquals([
            'testo' => [
                'test1' => 'test-1',
                'test2' => 'test-2',
            ],
        ], $context->getOptions());
        $this->assertEquals('test-1', $context->getOption('testo', 'test1'));

        $context->onResolve(function () {
        });
        $context->onConnect(function () {
        });
        $context->onAuthRequired(function () {
        });
        $context->onMimeType(function (string $mimeType) {
        });
        $context->onFileSize(function (int $fileSize) {
        });
        $context->onRedirected(function (string $uri) {
        });
        $context->onProgress(function (int $transferred, int $max) {
        });
        $context->onCompleted(function () {
        });
        $context->onFailure(function (string $message, int $code) {
        });
        $context->onAuthResult(function () {
        });
    }
}
