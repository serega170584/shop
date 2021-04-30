<?php


namespace App\Factory;


use App\Entity\Basket;
use App\Repository\BasketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BasketFactory
{
    /**
     * @var Basket
     */
    private $basket;
    /**
     * @var BasketRepository
     */
    private $basketRepository;

    public function __construct(Basket $basket, BasketRepository $basketRepository, SessionInterface $session)
    {
        $this->basket = $basket;
        $this->basketRepository = $basketRepository;
    }

    public function getBasket()
    {
        $id = $this->controller->getReqgetSession()->getId();
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