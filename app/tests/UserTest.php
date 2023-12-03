<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testReturnsFullName()
    {
        $user = new ser;
        $user->first_name = "Teresa";
        $user->surname = "Twelve";


        $this->assertEquals('Teresa Twelve', $user->getFullName());
    }

    //Check name is empty by default
    //Expecting ' '
    public function testFullNameIsEmptyByDefault()
    {
        $user = new User;
        $this->assertEquals('', $user->getFullName());
    }

    /**
     * @test
     */
    public function user_has_first_name()
    {
        $user = new User;
        $user->first_name = "Teresa";
        $this->assertEquals('Teresa', $user->first_name);
    }
}