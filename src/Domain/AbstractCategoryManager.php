<?php


namespace App\Domain;


use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;

abstract class AbstractCategoryManager
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

    public function __construct(CategoryRepository $repository)
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

    abstract public function inflate();
}