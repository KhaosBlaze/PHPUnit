<?php

namespace Classes;

/**
 * Item
 * 
 * An example Item class
 */
class Item
{
    /**
     * Get the description
     * 
     * @return integer A random integer
     */
    public function getDescription()
    {
        return $this->getID() . $this->getToken();
    }

    /**
     * Get a random ID
     * 
     * @return integer The ID
     */
    protected function getID()
    {
        return rand();
    }

    /**
     * Get a random token
     * 
     * @return string The Token
     */
    private function getToken()
    {
        return uniqid();
    }

    /**
     * Get a random token with a specified prefix
     * 
     * @param string $prefix token prefix
     * 
     * @return string The token
     */
    private function getPrefixedToken(string $prefix)
    {
        return uniqid($prefix);
    }
}