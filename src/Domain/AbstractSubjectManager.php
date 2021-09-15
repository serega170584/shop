<?php


namespace App\Domain;


use App\Repository\CategoryRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

abstract class AbstractSubjectManager
{
    protected const ID = 'id';
    protected const LIMIT = 5;
    /**
     * @var ArrayCollection
     */
    protected $items;
    /**
     * @var CategoryRepository
     */
    protected $repository;

    public function __construct(ServiceEntityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return ArrayCollection
     */
    public function getItems(): ArrayCollection
    {
        return $this->items;
    }

    public function inflate(): self
    {
        $this->items = new ArrayCollection($this->repository->findBy(
            [],
            [
                self::ID => Criteria::DESC
            ],
            self::LIMIT
        ));
        return $this;
    }
}