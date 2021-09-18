<?php


namespace App\Domain\SubjectManager;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;

abstract class AbstractSubjectManager
{
    /**
     * @var ArrayCollection
     */
    protected $items;
    /**
     * @var ServiceEntityRepository
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
}