<?php


namespace App\EntityListener;


use App\Entity\News;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints as Assert;

class NewsEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(News $news, LifecycleEventArgs $event)
    {
        $news->computeSlug($this->slugger);
    }

    public function preUpdate(News $news, LifecycleEventArgs $event)
    {
        $news->computeSlug($this->slugger);
    }
}