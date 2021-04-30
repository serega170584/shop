<?php


namespace App\Factory;


use App\Entity\Basket;
use App\Repository\BasketRepository;
use Symfony\Component\HttpFoundation\Request;

class BasketFactory
{
    /**
     * @var Basket
     */
    private $basket;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var BasketRepository
     */
    private $basketRepository;

    public function __construct(Basket $basket, Request $request, BasketRepository $basketRepository)
    {
        $this->basket = $basket;
        $this->request = $request;
        $this->basketRepository = $basketRepository;
    }

    public function getBasket()
    {
        $id = $this->request->getSession()->getId();
        var_dump($id);
        if ($foundBasket = $this->basketRepository->findOneBy([
            'sessionId' => $id
        ])) {
            $this->basket = $foundBasket;
        } else {
            $this->basket->setSessionId($id);
        }
        return $this->basket;
    }
}