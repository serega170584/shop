<?php


namespace App\Domain\PageManager;


use App\Domain\InflatorInterface;
use App\Domain\SubjectManager\CategoryManager;
use App\Domain\SubjectManager\EventManager;
use App\Domain\SubjectManager\NewsManager;
use App\Domain\SubjectManager\ProductManager;
use App\Domain\SubjectManager\VideoManager;
use App\Form\ProductAddFormType;
use Symfony\Component\Form\Forms;

class MainPageManager extends AbstractPageManager implements InflatorInterface
{
    /**
     * @var CategoryManager
     */
    private $categoryManager;
    /**
     * @var EventManager
     */
    private $eventManager;
    /**
     * @var VideoManager
     */
    private $videoManager;
    /**
     * @var NewsManager
     */
    private $newsManager;

    public function __construct(ProductManager $productManager,
                                CategoryManager $categoryManager,
                                EventManager $eventManager,
                                VideoManager $videoManager,
                                NewsManager $newsManager
    )
    {
        parent::__construct($productManager);
        $this->categoryManager = $categoryManager;
        $this->eventManager = $eventManager;
        $this->videoManager = $videoManager;
        $this->newsManager = $newsManager;
        $this->form = Forms::createFormFactory()->create(ProductAddFormType::class);
    }

    public function inflate()
    {
        $this->subjectManager->inflate();
        $this->categoryManager->inflate();
        $this->eventManager->inflate();
        $this->videoManager->inflate();
        $this->newsManager->inflate();
    }
}