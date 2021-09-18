<?php


namespace App\Domain\Repository;


trait RepositoryTrait
{
    public function createEntity()
    {
        return new $this->_entityName;
    }
}