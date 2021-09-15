<?php


namespace App\Domain;


use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class PlainProductManager extends AbstractSubjectManager
{
    const IS_POPULAR = 'isPopular';
    const ID = 'id';
    const POPULAR_LIMIT = 4;

    public function __construct(ProductRepository $repository)
    {
        parent::__construct($repository);
    }

    public function inflate()
    {
        $this->items = new ArrayCollection($this->repository->findBy([
            self::IS_POPULAR => true
        ], [
            self::ID => Criteria::DESC
        ], self::POPULAR_LIMIT
        ));
    }
}