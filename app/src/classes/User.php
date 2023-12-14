<?php

namespace Classes;

use Classes\Mailer;

/**
 * User
 * 
 * A user in the system
 */
class User
{
    /**
     * First name
     * @var string
     */
    public $first_name;

    /**
     * Last name
     * @var string
     */
    public $surname;

    /**
     * Email Address
     * @var string
     */
    public $email;

    /**
     * Mailer object
     * @var Mailer
     */
    protected $mailer;

    /**
     * Set the mailer dependency
     * 
     * @param Mailer $mailer The Mailer Object
     */
    public function setMailer(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Get the user's full name from their first name and usrname
     * @return string The user's full name
     */
    public function getFullName()
    {
        return trim($this->first_name . " " . $this->surname);
    }

    /**
     * Send $message to the User->$email
     * 
     * @param string $message Message to send to user
     * 
     * @return boolean True if sent, false otherwise
     */
    public function notify($message) 
    {
        return $this->mailer->sendMessage($this->email, $message);
    }
}