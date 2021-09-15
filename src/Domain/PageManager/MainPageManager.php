<?php


namespace App\Domain\PageManager;


use App\Domain\InflatorInterface;
use App\Domain\SubjectManager\CategoryManager;
use App\Domain\SubjectManager\EventManager;
use App\Domain\SubjectManager\NewsManager;
use App\Domain\SubjectManager\ProductManager;
use App\Domain\SubjectManager\VideoManager;
use App\Form\ProductAddFormType;
use App\Form\ProductDeleteFormType;
use Symfony\Component\Form\FormFactoryInterface;
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
    /**
     * @var \Symfony\Component\Form\FormInterface
     */
    private $productAddForm;
    /**
     * @var \Symfony\Component\Form\FormInterface
     */
    private $productDeleteForm;

    public function __construct(ProductManager $productManager,
                                CategoryManager $categoryManager,
                                EventManager $eventManager,
                                VideoManager $videoManager,
                                NewsManager $newsManager,
                                FormFactoryInterface $formFactory
    )
    {
        parent::__construct($productManager);
        $this->categoryManager = $categoryManager;
        $this->eventManager = $eventManager;
        $this->videoManager = $videoManager;
        $this->newsManager = $newsManager;
        $this->productAddForm = $formFactory->create(ProductAddFormType::class);
        $this->productDeleteForm = $formFactory->create(ProductDeleteFormType::class);
    }

    public function inflate()
    {
        $this->subjectManager->inflate();
        $this->categoryManager->inflate();
        $this->eventManager->inflate();
        $this->videoManager->inflate();
        $this->newsManager->inflate();
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getProductAddForm(): \Symfony\Component\Form\FormInterface
    {
        return $this->productAddForm;
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getProductDeleteForm(): \Symfony\Component\Form\FormInterface
    {
        return $this->productDeleteForm;
    }

    /**
     * @return CategoryManager
     */
    public function getCategoryManager(): CategoryManager
    {
        return $this->categoryManager;
    }

    /**
     * @return EventManager
     */
    public function getEventManager(): EventManager
    {
        return $this->eventManager;
    }

    /**
     * @return VideoManager
     */
    public function getVideoManager(): VideoManager
    {
        return $this->videoManager;
    }

    /**
     * @return NewsManager
     */
    public function getNewsManager(): NewsManager
    {
        return $this->newsManager;
    }
}