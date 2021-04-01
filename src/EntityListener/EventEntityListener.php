<?php


namespace App\EntityListener;


use App\Entity\Event;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints as Assert;

class EventEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Event $eventEntity, LifecycleEventArgs $event)
    {
        $eventEntity->computeSlug($this->slugger);
    }

    public function preUpdate(Event $eventEntity, LifecycleEventArgs $event)
    {
        $eventEntity->computeSlug($this->slugger);
    }
}