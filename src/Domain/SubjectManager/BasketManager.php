<?php


namespace App\Domain\SubjectManager;


use App\Domain\InflatorInterface;
use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BasketManager extends AbstractSubjectManager implements InflatorInterface
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

    public function inflate(): self
    {
        $sessionId = $this->session->getId();
        $basket = $this->repository->findBasket($sessionId);
        $basket = $basket ?? $this->repository->createEntity();
        $basket->setSessionId($sessionId);
        $this->items = $basket->getBasketProducts() ?? (new ArrayCollection());
        $this->basket = $basket;
        return $this;
    }

    /**
     * @return \App\Entity\Basket
     */
    public function getBasket(): \App\Entity\Basket
    {
        return $this->basket;
    }
}