<?php

namespace App\EventSubscriber;

use App\Factory\BasketFactory;
use App\Repository\BasketRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Twig\Environment;

class SiteEventSubscriber implements EventSubscriberInterface
{
    public const SESSION_INTERVAL = 60;

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
        $this->twig->addGlobal('categories', $this->categoryRepository->findAll());
        $this->twig->addGlobal('popularProducts', $this->productRepository->findPopular());
        $this->twig->addGlobal('basket', $this->basketFactory->getBasket());
        $this->twig->addGlobal('sessionInterval', self::SESSION_INTERVAL);
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $session = $request->getSession();
        if (!$session->isStarted()) {
            $session->start();
        }
        $interval = time() - $session->getMetadataBag()->getLastUsed();
        if ($interval > self::SESSION_INTERVAL) {
            $session->invalidate();
            $response = new RedirectResponse($request->getRequestUri());
            $response->send();
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
