<?php

declare(strict_types=1);

namespace Phrity\Net\Mock\Test;

use PHPUnit\Framework\TestCase;
use Phrity\Net\Mock\{
    Mock,
    Stream,
    StreamCollection,
    StreamFactory,
};

/**
 * Phrity\Net\Mock\Test\StreamCollectionTest test class.
 */
class StreamCollectionTest extends TestCase
{
    public function testCollection(): void
    {
        Mock::setCallback(function ($counter, $method, $params, $default) {
            switch ($counter) {
                case 0:
                    $this->assertEquals('StreamFactory.__construct', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 1:
                    $this->assertEquals('StreamFactory.createStream', $method);
                    $this->assertEquals(['Stream'], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 2:
                    $this->assertEquals('StreamFactory.createStreamFromResource', $method);
                    $this->assertIsResource($params[0]);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 3:
                    $this->assertEquals('Stream.__construct', $method);
                    $this->assertIsResource($params[0]);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 4:
                    $this->assertEquals('Stream.getMetadata', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                    break;
                case 5:
                    $this->assertEquals('StreamFactory.createStreamCollection', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 6:
                    $this->assertEquals('StreamCollection.__construct', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
                case 7:
                    $this->assertEquals('StreamCollection.attach', $method);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 8:
                    $this->assertEquals('StreamCollection.count', $method);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 9:
                    $this->assertEquals('StreamCollection.detach', $method);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 10:
                    $this->assertEquals('StreamCollection.getReadable', $method);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 11:
                    $this->assertEquals('StreamCollection.getWritable', $method);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 12:
                    $this->assertEquals('StreamCollection.waitRead', $method);
                    $this->assertIsCallable($default);
                    return $default($params);
                case 13:
                    $this->assertEquals('StreamCollection.__construct', $method);
                    $this->assertEquals([], $params);
                    $this->assertIsCallable($default);
                    $default($params);
                    break;
            }
        });

        $factory = new StreamFactory();
        $stream = $factory->createStream('Stream');
        $collection = $factory->createStreamCollection();
        $collection->attach($stream, 'my_key');
        $this->assertCount(1, $collection);
        foreach ($collection as $key => $stream) {
            ;
        }
        $collection->detach($stream);
        $collection->getReadable();
        $collection->getWritable();
        $collection->waitRead();
    }
}
