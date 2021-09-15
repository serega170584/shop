<?php


namespace App\Domain\PageManager;


use Doctrine\ORM\EntityManager;

abstract class AbstractPageManager
{

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    abstract public function inflate();
}