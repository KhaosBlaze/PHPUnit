<?php

use Classes\Queue;
use Exceptions\QueueException;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    protected static $queue;

    protected function setUp(): void
    {
        static::$queue->clear();
    }

    public static function setUpBeforeClass(): void
    {
        static::$queue = new Queue;
    }

    public static function tearDownAfterClass(): void
    {
        static::$queue = null;
    }

    public function testNewQueueIsEmpty()
    {
        $this->assertEquals(0, static::$queue->getCount());
    }

    public function testAnItemIsAddedToTheQueue()
    {
        static::$queue->push('green');
        $this->assertEquals(1, static::$queue->getCount());
    }

    public function testAnItemIsRemovedFromTheQueue()
    {
        static::$queue->push('green');
        $item = static::$queue->pop();
        $this->assertEquals(0, static::$queue->getCount());
        $this->assertEquals('green', $item);
    }

    //Reuse above 2 methods but utilizing depends keyword

    public function testDependencyAnItemIsAddedToTheQueue()
    {
        $queue = new Queue;
        $queue->push('green');
        $this->assertEquals(1, $queue->getCount());
        return $queue;
    }

    /**
     * @depends testDependencyAnItemIsAddedToTheQueue
     */
    public function testDependencyAnItemIsRemovedFromTheQueue(Queue $queue)
    {
        $item = $queue->pop();
        $this->assertEquals(0, $queue->getCount());
        $this->assertEquals('green', $item);
    }

    public function testAnItemIsRemovedFromFrontOfTheQueue()
    {
        static::$queue->push('first');
        static::$queue->push('second');

        $this->assertEquals('first', static::$queue->pop());
    }

    public function testMaxNumberOfItemsCanBeAdded()
    {
        $queue = new Queue;
        for ($i = 0; $i < Queue::MAX_ITEMS; $i++) {
            $queue->push($i);
        }
        $this->assertEquals(Queue::MAX_ITEMS, $queue->getCount());
        return $queue;
    }

    /**
     * @depends testMaxNumberOfItemsCanBeAdded
     */
    public function testExceptionThrownWhenAddingToAFullQueue(Queue $queue)
    {
        $this->assertEquals(Queue::MAX_ITEMS, $queue->getCount());
        $this->expectException(QueueException::class);
        $this->expectExceptionMessage("Queue is full");
        $queue->push('Throw an exception');
    }
}