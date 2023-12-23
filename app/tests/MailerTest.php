<?php

use PHPUnit\Framework\TestCase;
use Classes\Mailer;

class MailerTest extends TestCase
{
    public function testSendMessageReturnsTrue()
    {
        $this->AssertTrue(Mailer::send('charless@example.com', 'Hello!'));
    }

    public function testInvalidArgumentExceptionIfEmailIsEmpty()
    {
        $this->expectException(InvalidArgumentException::class);
        
        Mailer::send('','');
    }
}