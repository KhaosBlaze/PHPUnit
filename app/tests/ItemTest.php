<?php

use PHPUnit\Framework\TestCase;
use Classes\Item;
use Classes\ItemChild;

class ItemTest extends TestCase
{
    protected $item;

    protected function setUp(): void
    {
        $this->item = new Item;
    }
    
    public function testDescriptionIsNotEmpty()
    {
        $this->assertNotEmpty($this->item->getDescription());
    }

    public function testIDisAnInteger()
    {
        $item = new ItemChild;
        $this->assertIsInt($item->getID());
    }

    public function testTokenIsString()
    {
        $reflector = new ReflectionClass(Item::class);
        $method = $reflector->getMethod('getToken');
        $method->setAccessible(true);

        $result = $method->invoke($this->item);

        $this->assertIsString($result);
    }

    public function testPrefixedTokenIsString()
    {
        $reflector = new ReflectionClass(Item::class);
        $method = $reflector->getMethod('getPrefixedToken');
        $method->setAccessible(true);

        $prefix = 'example';

        $result = $method->invokeArgs($this->item, [$prefix]);

        $this->assertStringStartsWith($prefix, $result);
    }
}