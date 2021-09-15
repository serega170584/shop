<?php


namespace App\Domain;


class AbstractProductManager
{
    /**
     * @var AbstractCategoryManager
     */
    protected $categoryManager;

    public function __construct(AbstractCategoryManager $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    public function inflate()
    {
        $this->
    }
}