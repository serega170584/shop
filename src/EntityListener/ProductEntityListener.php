<?php


namespace App\EntityListener;


use App\Entity\Product;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ProductEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Product $product, LifecycleEventArgs $event)
    {
        $product->computeSlug($this->slugger);
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate(Product $product, LifecycleEventArgs $event)
    {
        die('asd');
        $product->computeSlug($this->slugger);
    }
}