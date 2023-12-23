<?php

use Classes\User;
use Classes\Mailer;
use Exceptions\MailerException;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testReturnsFullName()
    {
        $user = new User;
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

    public function testUserNotificationIsSent()
    {
        $user = new User;
        $email = 'test@domain.tld';
        $message = 'Test Message';

        //Setup mock Mailer
        $mock_mailer = $this->createMock(Mailer::class);
        $mock_mailer->expects($this->once())
                    ->method('sendMessage')
                    ->with($this->equalTo($email), $this->equalTo($message))
                    ->willReturn(true);

        $user->setMailer($mock_mailer);

        $user->email = $email;
        $result = $user->notify($message);
        $this->assertTrue($result);
    }

    public function testCannotNotifyUserWithNoEmail()
    {
        $user = new User;

        $mock_mailer = $this->getMockBuilder(Mailer::class)
                            ->onlyMethods([])
                            ->getMock();
        $user->setMailer($mock_mailer);

        $this->expectException(MailerException::class);
        $this->expectExceptionMessage("No Email Address");
        $user->notify("Hello");
    }

    public function testNotifyStaticReturnsTrue()
    {
        $user = new User;
        $user->email = 'test@domain.tld';

        $this->assertTrue($user->notifyStatic('Hello!'));
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testNotifyStaticAliasReturnsTrue()
    {
        $user = new User;
        $user->email = 'test@domain.tld';

        $mock = Mockery::mock('alias:\Classes\Mailer');

        $mock->shouldReceive('send')
            ->once()
            ->with($user->email, 'Hello!')
            ->andReturn(true);

        $user->setMailer($mock);

        $this->assertTrue($user->notifyStatic('Hello!'));
    }
}