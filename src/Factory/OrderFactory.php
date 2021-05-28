<?php


namespace App\Factory;


use App\Entity\Order;

class OrderFactory
{
    /**
     * @var Order
     */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }
}