<?php

use Classes\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testOrderIsProcessed()
    {
        $gateway = $this->getMockBuilder(\stdClass::class)
                        ->setMockClassName('PaymentGateway')
                        ->addMethods(array('charge'))
                        ->getMock();

        $orderAmount = 200;

        $gateway->expects($this->once())
                ->method('charge')
                ->with($this->equalTo($orderAmount))
                ->willReturn(true);

        $order = new Order($gateway);
        $order->amount = $orderAmount;
        $this->assertTrue($order->process());
    }

    public function testOrderIsProcessedUsingMockery()
    {
        $gateway = Mockery::mock('PaymentGateway');

        $orderAmount = 200;

        $gateway->shouldReceive('charge')
                ->once()
                ->with($orderAmount)
                ->andReturn(true);

        $order = new Order($gateway);
        $order->amount = $orderAmount;
        $this->assertTrue($order->process()); 
    }

    public function testCalculateOrderUsingAMock()
    {
        $quantity = 10;
        $unit_price = 1.02;
        $orderAmount = $quantity * $unit_price; //10.2

        $gateway = Mockery::mock('PaymentGateway');
        $gateway->shouldReceive('charge')
                ->once()
                ->with($orderAmount)
                ->andReturn(true);

        $order = new Order($gateway);
        $order->calculateOrder($quantity, $unit_price);
        
        $this->assertTrue($order->process());
    }

    public function testOrderIsProcessedUsingASpy()
    {
        $quantity = 10;
        $unit_price = 1.02;
        $orderAmount = $quantity * $unit_price; //10.2

        $gateway_spy = Mockery::spy('PaymentGateway');

        $order = new Order($gateway_spy);
        $order->calculateOrder($quantity, $unit_price);
        $this->assertEquals($orderAmount, $order->amount);

        $order->process();

        $gateway_spy->shouldHaveReceived('charge')
                    ->once()
                    ->with($orderAmount);
    }
}