<?php


namespace App\Domain;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class PlainCategoryManager extends AbstractCategoryManager
{
    public function inflate(): self
    {
        $this->items = new ArrayCollection($this->repository->findBy(
            [],
            [
                self::ID => Criteria::DESC
            ],
            self::LIMIT
        ));
        return $this;
    }
}