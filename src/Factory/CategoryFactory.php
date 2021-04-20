<?php


namespace App\Factory;


use App\Entity\Category;

class CategoryFactory
{
    /**
     * @var Category
     */
    private $cat;

    public function __construct(Category $cat)
    {
        $this->cat = $cat;
    }

    public function getCat()
    {
        return $this->cat;
    }
}