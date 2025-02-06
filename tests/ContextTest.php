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
        $context->setParams(['notification' => 'testp-1']);
        $context->setParam('notification', 'testp-2');
        $this->assertEquals([
            'options' => [],
            'notification' => 'testp-2',
        ], $context->getParams());
        $this->assertEquals('testp-2', $context->getParam('notification'));

        $context->setOptions(['testo' => ['test1' => 'test-1']]);
        $context->setOption('testo', 'test2', 'test-2');
        $this->assertEquals([
            'testo' => [
                'test1' => 'test-1',
                'test2' => 'test-2',
            ],
        ], $context->getOptions());
        $this->assertEquals('test-1', $context->getOption('testo', 'test1'));
    }
}
