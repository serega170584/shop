<?php


namespace App\Domain\Repository;


trait RepositoryTrait
{
    public function createEntity()
    {
        return $this->_entityName;
    }
}