<?php


namespace App\EntityListener;

use App\Entity\OrderStatus;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class OrderStatusEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(OrderStatus $orderStatus, LifecycleEventArgs $event)
    {
        $orderStatus->computeSlug($this->slugger);
    }

    public function preUpdate(OrderStatus $orderStatus, LifecycleEventArgs $event)
    {
        $orderStatus->computeSlug($this->slugger);
    }
}