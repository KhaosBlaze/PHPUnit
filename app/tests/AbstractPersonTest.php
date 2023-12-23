<?php

use PHPUnit\Framework\TestCase;
use Classes\AbstractPerson;
use Classes\Doctor;

class AbstractPersonTest extends TestCase
{
    public function testNameAndTitleIsReturned()
    {
        $doctor = new Doctor('Green');

        $this->assertEquals('Dr. Green', $doctor->getNameAndTitle());
    }

    public function testNameAndTitleIncludesValueFromGetTitle()
    {
        $mock = $this->getMockBuilder(AbstractPerson::class)
                    ->setConstructorArgs(['Green'])
                    ->getMockFOrAbstractClass();

        $mock->expects($this->once())
            ->method('getTitle')
            ->willReturn('Mr.');

        $this->assertEquals('Mr. Green', $mock->getNameAndTitle());
    }
}