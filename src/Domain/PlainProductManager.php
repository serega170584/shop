<?php


namespace App\Domain;


use App\Repository\ProductRepository;

class PlainProductManager extends AbstractSubjectManager
{
    public function __construct(ProductRepository $repository)
    {
        parent::__construct($repository);
    }
}