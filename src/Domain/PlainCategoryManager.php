<?php


namespace App\Domain;


use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Criteria;

class PlainCategoryManager extends AbstractSubjectManager
{
    private const ID = 'id';
    private const LIMIT = 5;

    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }

    public function inflate(): self
    {
        $this->items = $this->repository->findLastRows(
            [],
            [
                self::ID => Criteria::DESC
            ],
            self::LIMIT
        );
        return $this;
    }
}