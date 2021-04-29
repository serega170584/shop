<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Event;
use App\Entity\News;
use App\Entity\Product;
use App\Entity\Video;
use App\Factory\BasketFactory;
use App\Factory\BasketItemFactory;
use App\Form\ProductAddFormType;
use App\Form\ProductDeleteFormType;
use App\Repository\BasketItemRepository;
use App\Repository\BasketRepository;
use App\Repository\CategoryRepository;
use App\Repository\EventRepository;
use App\Repository\NewsRepository;
use App\Repository\ProductRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\MigratingSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @var BasketFactory
     */
    private $factory;

    public function __construct(BasketFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @Route("/", name="index")
     * @param Request $request
     * @param BasketFactory $basketFactory
     * @return Response
     */
    public function index(Request $request, BasketFactory $basketFactory): Response
    {
        /**
         * @var CategoryRepository $repository
         */
        $repository = $this->getDoctrine()->getManager()
            ->getRepository(Category::class);
        $categories = $repository->findLastRows(5);
        /**
         * @var EventRepository $repository
         */
        $repository = $this->getDoctrine()->getManager()
            ->getRepository(Event::class);
        $events = $repository->findLastRows(3);
        /**
         * @var VideoRepository $repository
         */
        $repository = $this->getDoctrine()->getManager()
            ->getRepository(Video::class);
        $videos = $repository->findLastRows(3);
        $firstVideo = array_shift($videos);
        /**
         * @var ProductRepository $repository
         */
        $repository = $this->getDoctrine()->getManager()
            ->getRepository(Product::class);
        $products = $repository->findPopular();
        $sliderProducts = $repository->findIsSlider();
        /**
         * @var NewsRepository $repository
         */
        $repository = $this->getDoctrine()->getManager()
            ->getRepository(News::class);
        $news = $repository->findLastRows(4);
        $form = $this->createForm(ProductAddFormType::class);
        $productDeleteForm = $this->createForm(ProductDeleteFormType::class);
        $basket = $basketFactory->getBasket();
        foreach ($products as $val) {
            $items = $basket->getBasketItems();
            $curr = $items->next();
            echo gettype($curr);
            var_dump($items->contains($curr));
        }
        die('asd');
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'categories' => $categories,
            'products' => $products,
            'events' => $events,
            'firstVideo' => $firstVideo,
            'videos' => $videos,
            'news' => $news,
            'sliderProducts' => $sliderProducts,
            'form' => $form->createView(),
            'productDeleteForm' => $productDeleteForm->createView()
        ]);
    }

    /**
     * @Route("/productAdd", name="productAdd")
     * @param Request $request
     * @param BasketFactory $factory
     * @param BasketRepository $repository
     * @param BasketItemFactory $basketItemFactory
     * @param BasketItemRepository $basketItemRepository
     * @param ProductRepository $productRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function productAdd(Request $request, BasketFactory $factory, BasketRepository $repository,
                               BasketItemFactory $basketItemFactory, BasketItemRepository $basketItemRepository,
                               ProductRepository $productRepository)
    {
        $basketItem = $basketItemFactory->getBasketItem();
        $form = $this->createForm(ProductAddFormType::class, $basketItem);
        $form->handleRequest($request);
        $sessionId = $request->getSession()->getId();
        if (!($basket = $repository->findOneBy(['sessionId' => $sessionId]))) {
            $basket = $factory->getBasket();
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $basket->setSessionId($sessionId);
            $entityManager->persist($basket);
            $entityManager->flush();
            $product = $productRepository->findOneBy([
                'id' => $basketItem->getProduct()->getId()
            ]);
            if ($foundBasketItem = $basketItemRepository->findOneBy([
                'basket' => $basket,
                'product' => $product
            ])) {
                $basketItem = $foundBasketItem;
            }
            $basket->addBasketItem($basketItem);
            $basketItem->setProduct($product);
            $basketItem->setBasket($basket);
            $entityManager->persist($basketItem);
            $entityManager->flush();
        } else {
            throw $this->createNotFoundException();
        }
        return $this->json([
            'count' => $basket->getBasketItems()->count()
        ]);
    }

    /**
     * @Route("/productDelete", name="productDelete")
     * @param Request $request
     * @param BasketRepository $repository
     * @param BasketItemFactory $basketItemFactory
     * @param BasketItemRepository $basketItemRepository
     * @param ProductRepository $productRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function productDelete(Request $request, BasketRepository $repository,
                                  BasketItemFactory $basketItemFactory, BasketItemRepository $basketItemRepository,
                                  ProductRepository $productRepository)
    {
        $basketItem = $basketItemFactory->getBasketItem();
        $form = $this->createForm(ProductDeleteFormType::class, $basketItem);
        $form->handleRequest($request);
        $sessionId = $request->getSession()->getId();
        $basket = $repository->findOneBy(['sessionId' => $sessionId]);
        if ($form->isSubmitted() && $form->isValid() && $basket) {
            $entityManager = $this->getDoctrine()->getManager();
            $product = $productRepository->findOneBy([
                'id' => $basketItem->getProduct()->getId()
            ]);
            $basketItem = $basketItemRepository->findOneBy([
                'basket' => $basket,
                'product' => $product
            ]);
            $entityManager->remove($basketItem);
            $entityManager->flush();
        } else {
            throw $this->createNotFoundException();
        }
        return $this->json([
            'count' => $basket->getBasketItems()->count()
        ]);
    }

    /**
     * @Route("/popular", name="popular-products")
     */
    public function popular(): Response
    {
        /**
         * @var ProductRepository $repository
         */
        $repository = $this->getDoctrine()->getManager()
            ->getRepository(Product::class);
        $products = $repository->findPopular();
        return $this->render('popular-products/show.html.twig', [
            'title' => 'Популярные курсы',
            'controller_name' => 'IndexController',
            'products' => $products
        ]);
    }

    /**
     * @Route("/popular/list", name="popular-products-list")
     */
    public function popularList(): Response
    {
        /**
         * @var ProductRepository $repository
         */
        $repository = $this->getDoctrine()->getManager()
            ->getRepository(Product::class);
        $products = $repository->findPopular();
        return $this->render('popular-products/list-show.html.twig', [
            'title' => 'Популярные курсы',
            'controller_name' => 'IndexController',
            'products' => $products
        ]);
    }
}
