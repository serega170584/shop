<?php


namespace App\Domain\SubjectManager;


use App\Domain\InflatorInterface;
use App\Repository\CategoryRepository;

class PlainCategoryManager extends AbstractSubjectManager implements InflatorInterface
{
    use LastItemTrait;

    private const ID = 'id';
    private const LIMIT = 5;

    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }
}