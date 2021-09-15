<?php


namespace App\Domain\SubjectManager;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

trait LastItemTrait
{
    public function inflate(): self
    {
        $this->items = new ArrayCollection($this->repository->findBy(
            [],
            [
                self::ID => Criteria::DESC
            ], self::LIMIT));
        return $this;
    }
}