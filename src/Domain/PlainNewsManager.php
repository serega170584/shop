<?php


namespace App\Domain;


use App\Repository\EventRepository;

class PlainNewsManager extends AbstractSubjectManager
{
    use LastItemTrait;

    private const ID = 'id';
    private const LIMIT = 4;

    public function __construct(EventRepository $repository)
    {
        parent::__construct($repository);
    }
}