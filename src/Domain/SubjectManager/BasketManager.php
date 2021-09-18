<?php


namespace App\Domain\SubjectManager;


use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BasketManager extends AbstractSubjectManager
{
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var \App\Entity\Basket
     */
    private $basket;

    public function __construct(BasketRepository $repository, SessionInterface $session)
    {
        parent::__construct($repository);
        $this->repository = $repository;
        $this->session = $session;
    }

    public function inflate()
    {
        $basket = $this->repository->findBasket($this->session->getId());
        $this->basket = $basket ?? $this->repository->createEntity();
        $this->items = $this->basket->getBasketProducts() ?? new ArrayCollection();
    }

    /**
     * @return \App\Entity\Basket
     */
    public function getBasket(): \App\Entity\Basket
    {
        return $this->basket;
    }
}