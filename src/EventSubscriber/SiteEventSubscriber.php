<?php

namespace App\EventSubscriber;

use App\Factory\BasketFactory;
use App\Repository\BasketRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Twig\Environment;

class SiteEventSubscriber implements EventSubscriberInterface
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
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(Environment $twig, CategoryRepository $categoryRepository, ProductRepository $productRepository,
                                BasketFactory $basketFactory, BasketRepository $basketRepository, LoggerInterface $logger)
    {
        $this->twig = $twig;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->basketFactory = $basketFactory;
        $this->basketRepository = $basketRepository;
        $this->logger = $logger;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $this->twig->addGlobal('categories', $this->categoryRepository->findAll());
        $this->twig->addGlobal('popularProducts', $this->productRepository->findPopular());
        $this->twig->addGlobal('basket', $this->basketFactory->getBasket());
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $session = $request->getSession();
        $interval = time() - $session->getMetadataBag()->getLastUsed();
        if ($interval > 60) {
            $this->logger->info('redirect');
            return new RedirectResponse($request->getRequestUri());
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
            'kernel.request' => 'onKernelRequest'
        ];
    }
}
