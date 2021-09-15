<?php


namespace App\Domain\PageManager;


use App\Domain\SubjectManager\AbstractSubjectManager;

abstract class AbstractPageManager
{
    /**
     * @var AbstractSubjectManager
     */
    protected $subjectManager;

    public function __construct(AbstractSubjectManager $subjectManager)
    {
        $this->subjectManager = $subjectManager;
    }
}