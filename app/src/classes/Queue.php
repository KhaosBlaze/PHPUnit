<?php

namespace Classes;

use Exceptions\QueueException;

/**
 * Queue
 * 
 * FILO data structure
 */
class Queue
{
    /**
     * Maximum number of items in the queue
     * @var integer
     */
    public const MAX_ITEMS = 5;

    /**
     * Queue items
     * @var array
     */
    protected $items = [];

    /**
     * Add an item to the end of the queue
     * 
     * @param mixed $item The item
     * 
     * @thows QueueException if the number of items on the queue exeeds
     *                          the MAX_ITEMS value
     */
    public function push($item)
    {
        if($this->getCount() == static::MAX_ITEMS) {
            throw new QueueException("Queue is full");
        }
        $this->items[] = $item;
    }

    /**
     * Removes from the front of the queue
     */
    public function pop()
    {
        return array_shift($this->items);
    }

    /**
     * Get the total number of items in the queue
     * 
     * @return integer The number of items
     */
    public function getCount()
    {
        return count($this->items);
    }

    /**
     * Empties queue
     */
    public function clear()
    {
        $this->items = [];
    }
}