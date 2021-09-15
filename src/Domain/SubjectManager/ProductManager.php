<?php


namespace App\Domain\SubjectManager;


use App\Domain\InflatorInterface;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class ProductManager extends AbstractSubjectManager implements InflatorInterface
{
    const IS_POPULAR = 'isPopular';
    const ID = 'id';
    const POPULAR_LIMIT = 4;
    const SLIDER_LIMIT = 5;
    const IS_SLIDER = 'isSlider';
    /**
     * @var Product[]|ArrayCollection
     */
    private $sliderItems;

    public function __construct(ProductRepository $repository)
    {
        parent::__construct($repository);
    }

    public function inflate(): self
    {
        $this->items = new ArrayCollection($this->repository->findBy([
            self::IS_POPULAR => true
        ], [
            self::ID => Criteria::DESC
        ], self::POPULAR_LIMIT
        ));

        $this->sliderItems = new ArrayCollection($this->repository->findBy([
            self::IS_SLIDER => true
        ], [
            self::ID => Criteria::DESC
        ], self::SLIDER_LIMIT
        ));

        return $this;
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getSliderItems()
    {
        return $this->sliderItems;
    }
}