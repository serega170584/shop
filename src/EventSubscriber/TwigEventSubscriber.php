<?php

namespace App\EventSubscriber;

use App\Factory\BasketFactory;
use App\Repository\BasketRepository;
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
    /**
     * @var BasketRepository
     */
    private $basketRepository;

    public function __construct(Environment $twig, CategoryRepository $categoryRepository, ProductRepository $productRepository,
                                BasketFactory $basketFactory, BasketRepository $basketRepository)
    {
        $this->twig = $twig;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->basketFactory = $basketFactory;
        $this->basketRepository = $basketRepository;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $event->getRequest()->getSession()->start();
        $this->twig->addGlobal('categories', $this->categoryRepository->findAll());
        $this->twig->addGlobal('popularProducts', $this->productRepository->findPopular());
        $id = $event->getRequest()->getSession()->getId();
        var_dump($id);
        if (!($basket = $this->basketRepository->findOneBy([
            'sessionId' => $id
        ]))) {
            $basket = $this->basketFactory->getBasket();
            $basket->setSessionId($id);
        }
        $this->twig->addGlobal('basket', $basket);
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}
