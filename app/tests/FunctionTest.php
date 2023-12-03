<?php

use PHPUnit\Framework\TestCase;

class FunctionTest extends TestCase
{
    public function testAddReturnsTheCorrectSum()
    {
        $this->assertEquals(6, addThree(2, 2, 2));
        $this->assertEquals(14, addThree(2, 8, 4));
    }

    public function testAddDoesNotReturnTheCorrectSum()
    {
        $this->assertNotEquals(6784, addThree(2, 2, 2));
        $this->assertNotEquals(7, addThree(2, 8, 4));
    }
}