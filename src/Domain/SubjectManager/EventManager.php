<?php


namespace App\Domain\SubjectManager;


use App\Domain\InflatorInterface;
use App\Repository\EventRepository;

class EventManager extends AbstractSubjectManager implements InflatorInterface
{
    use LastItemTrait;

    private const ID = 'id';
    private const LIMIT = 3;

    public function __construct(EventRepository $repository)
    {
        parent::__construct($repository);
    }
}