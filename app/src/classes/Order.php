<?php

namespace Classes;

/**
 * Order
 * 
 * An example Order class
 */
class Order
{
    /**
     * Amount
     * @var int
     */
    public $amount = 0;

    /**
     * Quantity
     * @var int
     */
    public $quantity = 0;

    /**
     * Unit Price
     * @var float
     */
    public $unit_price = 0;

    /**
     * Payment Gateway dependency
     * @var PaymentGateway
     */
    protected $gateway;

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct(\PaymentGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Calculate order amount
     * 
     * @param int $quantity Quantity
     * @param float $unit_price Unit Price
     * 
     * @return Void
     */
    public function calculateOrder(int $quantity, float $unit_price)
    {
        $this->quantity = $quantity;
        $this->unit_price = $unit_price;

        $this->amount = $this->quantity * $this->unit_price;
    }

    /**
     * Process the order
     * 
     * @return boolean
     */
    public function process()
    {
        return $this->gateway->charge($this->amount);
    }
}