<?php


namespace App\Domain;


use App\Repository\EventRepository;

class PlainEventManager extends AbstractSubjectManager
{
    use LastItemTrait;

    private const ID = 'id';
    private const LIMIT = 3;

    public function __construct(EventRepository $repository)
    {
        parent::__construct($repository);
    }
}