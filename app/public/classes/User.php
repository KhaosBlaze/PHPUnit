<?php

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
     * Get the user's full name from their first name and usrname
     * @return string The user's full name
     */
    public function getFullName()
    {
        return trim($this->first_name . " " . $this->surname);
    }
}