<?php


namespace App\Domain;


use App\Repository\CategoryRepository;

class PlainCategoryManager extends AbstractSubjectManager
{
    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }
}