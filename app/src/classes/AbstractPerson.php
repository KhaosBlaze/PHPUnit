<?php

namespace Classes;

/**
 * An example of an abstract person class
 */
abstract class AbstractPerson
{
    /**
     * Surname
     * @var string
     */
    protected $surname;

    /**
     * Constructor
     * 
     * @param string $surname The Person's surname
     * 
     * @return void
     */
    public function __construct(string $surname)
    {
        $this->surname = $surname;
    }

    /**
     * Get the person's title
     * 
     * @return string
     */
    abstract protected function getTitle();

    /**
     * Get the person's name
     * 
     * @return string
     */
    public function getNameAndTitle()
    {
        return $this->getTitle() . ' ' . $this->surname;
    }
}