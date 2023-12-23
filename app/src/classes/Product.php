<?php

namespace Classes;

/**
 * Product
 * 
 * An example product class
 */
class Product
{
    /**
     * Unique Identifier
     * @var integer
     */
    protected $product_id;

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct()
    {
        $this->product_id = rand();
    }
}