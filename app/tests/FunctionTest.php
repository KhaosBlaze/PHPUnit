<?php

use PHPUnit\Framework\TestCase;
use Mathlite\Addition;

class FunctionTest extends TestCase
{
    public function testAddReturnsTheCorrectSum()
    {
        $this->assertEquals(6, Addition::addThree(2, 2, 2));
        $this->assertEquals(14, Addition::addThree(2, 8, 4));
    }

    public function testAddDoesNotReturnTheCorrectSum()
    {
        $this->assertNotEquals(6784, Addition::addThree(2, 2, 2));
        $this->assertNotEquals(7, Addition::addThree(2, 8, 4));
    }
}