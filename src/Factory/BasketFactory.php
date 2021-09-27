<?php


namespace App\Factory;


use App\Entity\Basket;
use App\Repository\BasketRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var EntityManagerInterface
     */
    private $mgr;

    public function __construct(Basket $basket, BasketRepository $basketRepository, SessionInterface $session, EntityManagerInterface $mgr)
    {
        $this->basket = $basket;
        $this->basketRepository = $basketRepository;
        $this->session = $session;
        $this->mgr = $mgr;
    }

    public function getBasket(): Basket
    {
        $id = $this->session->getId();
        if ($foundBasket = $this->basketRepository->findOneBy([
            'sessionId' => $id,
            'isActive' => true
        ])) {
            $this->basket = $foundBasket;
        } else {
            $this->basket->setSessionId($id);
        }
        return $this->basket;
    }
}