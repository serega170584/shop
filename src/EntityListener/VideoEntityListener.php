<?php


namespace App\EntityListener;


use App\Entity\Video;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints as Assert;

class VideoEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Video $video, LifecycleEventArgs $event)
    {
        $video->computeSlug($this->slugger);
    }

    public function preUpdate(Video $video, LifecycleEventArgs $event)
    {
        $video->computeSlug($this->slugger);
    }
}