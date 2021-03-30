<?php


namespace App\EntityListener;


use App\Entity\Author;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class AuthorEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Author $author, LifecycleEventArgs $event)
    {
        $author->computeSlug($this->slugger);
    }

    public function preUpdate(Author $author, LifecycleEventArgs $event)
    {
        $author->computeSlug($this->slugger);
    }
}