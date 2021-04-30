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
    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(Basket $basket, BasketRepository $basketRepository, SessionInterface $session)
    {
        $this->basket = $basket;
        $this->basketRepository = $basketRepository;
        $this->session = $session;
    }

    public function getBasket()
    {
        $id = $this->session->getId();
        if (!$this->basket) {
            if ($foundBasket = $this->basketRepository->findOneBy([
                'sessionId' => $id
            ])) {
                $this->basket = $foundBasket;
            } else {
                $this->basket->setSessionId($id);
            }
        }
        return $this->basket;
    }
}