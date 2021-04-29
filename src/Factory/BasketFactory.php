<?php


namespace App\Factory;


use App\Entity\Basket;

class BasketFactory
{
    /**
     * @var Basket
     */
    private $basket;

    public function __construct(Basket $basket)
    {
//        echo '88888';
        $this->basket = $basket;
    }

    public function getBasket()
    {
        return $this->basket;
    }
}