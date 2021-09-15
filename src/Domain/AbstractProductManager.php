<?php


namespace App\Domain;


abstract class AbstractProductManager
{
    /**
     * @var AbstractCategoryManager
     */
    protected $categoryManager;

    public function __construct(AbstractCategoryManager $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    abstract public function inflate();
}