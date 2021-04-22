<?php


namespace App\Factory;


use App\Entity\BasketItem;

class BasketItemFactory
{
    /**
     * @var BasketItem
     */
    private $basketItem;

    public function __construct(BasketItem $basketItem)
    {
        $this->basketItem = $basketItem;
    }

    public function getBasketItem()
    {
        return $this->basketItem;
    }
}