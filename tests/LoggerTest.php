<?php

declare(strict_types=1);

namespace Phrity\Net\Mock\Test;

use PHPUnit\Framework\TestCase;
use Phrity\Net\Mock\{
    EchoLogger,
    Mock,
    StreamFactory,
};
use Psr\Log\{
    LoggerInterface,
    NullLogger
};

/**
 * Phrity\Net\Mock\Test\LoggerTest test class.
 */
class LoggerTest extends TestCase
{
    public function testLogger(): void
    {
        $logger = new EchoLogger();

        ob_start();
        $logger->warning("A {level} message.", [
            'level' => 'warning',
            'object' => (object)['a' => 'b'],
            'array' => [1]
        ]);
        $out = ob_get_clean();
        $this->assertEquals(
            "[warning] A warning message. {\"level\":\"warning\",\"object\":\"stdClass\",\"array\":\"array\"}\n",
            $out
        );
    }

    public function testMoggerLogger(): void
    {
        $logger = Mock::getLogger();
        $this->assertInstanceOf(LoggerInterface::class, $logger);
        $this->assertInstanceOf(NullLogger::class, $logger);

        Mock::setLogger(new EchoLogger());
        $logger = Mock::getLogger();
        $this->assertInstanceOf(LoggerInterface::class, $logger);
        $this->assertInstanceOf(EchoLogger::class, $logger);

        ob_start();
        $factory = new StreamFactory();
        $out = ob_get_clean();
        $this->assertEquals("[debug] StreamFactory.__construct {}\n", $out);

        Mock::setLogger(new NullLogger());
    }
}
