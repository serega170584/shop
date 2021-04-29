<?php

namespace App\EventSubscriber;

use App\Factory\BasketFactory;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $categoryRepository;
    private $productRepository;
    /**
     * @var BasketFactory
     */
    private $basketFactory;

    public function __construct(Environment $twig, CategoryRepository $categoryRepository, ProductRepository $productRepository,
                                BasketFactory $basketFactory)
    {
        $this->twig = $twig;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->basketFactory = $basketFactory;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $event->getRequest()->getSession()->start();
        $this->twig->addGlobal('categories', $this->categoryRepository->findAll());
        $this->twig->addGlobal('popularProducts', $this->productRepository->findPopular());
        var_dump($event->getRequest()->getSession()->getId());
//        $this->basketFactory->getBasket()->setSessionId($event->getRequest()->getSession()->getId());
        var_dump($event->getRequest()->getSession()->getId());
        $this->twig->addGlobal('basket', $this->basketFactory->getBasket());
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}
