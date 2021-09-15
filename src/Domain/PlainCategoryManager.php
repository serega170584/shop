<?php


namespace App\Domain;


use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

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