<?php


namespace App\Domain\SubjectManager;


use App\Repository\CategoryRepository;

class PlainCategoryManager extends AbstractSubjectManager
{
    use LastItemTrait;

    private const ID = 'id';
    private const LIMIT = 5;

    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }
}