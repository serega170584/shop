<?php

namespace App\Controller;

use App\Domain\FormManager\ProductAddFormManager;
use App\Domain\PageManager\MainPageManager;
use App\Entity\BasketItem;
use App\Entity\OrderStatus;
use App\Entity\Product;
use App\Factory\BasketFactory;
use App\Factory\BasketItemFactory;
use App\Factory\OrderFactory;
use App\Form\OrderFormType;
use App\Form\ProductDeleteFormType;
use App\Repository\OrderStatusRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @param MainPageManager $mainPageManager
     * @return Response
     */
    public function index(MainPageManager $mainPageManager): Response
    {
        $mainPageManager->inflate();
        return $this->render('index/index.html.twig', [
            'pageManager' => $mainPageManager,
        ]);
    }

    /**
     * @Route("/productAdd", name="productAdd")
     * @param ProductAddFormManager $productAddFormManager
     * @return JsonResponse
     */
    public function productAdd(ProductAddFormManager $productAddFormManager): JsonResponse
    {
        $productAddFormManager->execute();
        return $this->json([
            'count' => $productAddFormManager->getBasketManager()->getItems()->count()
        ]);
    }

    /**
     * @Route("/productDelete", name="productDelete")
     * @param Request $request
     * @param BasketFactory $factory
     * @param BasketItemFactory $basketItemFactory
     * @return JsonResponse
     */
    public function productDelete(Request $request, BasketFactory $factory, BasketItemFactory $basketItemFactory): JsonResponse
    {
        $basketItem = $basketItemFactory->getBasketItem();
        $form = $this->createForm(ProductDeleteFormType::class, $basketItem);
        $form->handleRequest($request);
        $basket = $factory->getBasket();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $productRepository = $this->getDoctrine()
                ->getManager()
                ->getRepository(Product::class);
            /**
             * @var Product $product
             */
            $product = $productRepository->findOneBy([
                'id' => $basketItem->getProduct()->getId()
            ]);
            $basketItemRepository = $this->getDoctrine()
                ->getManager()
                ->getRepository(BasketItem::class);
            /**
             * @var BasketItem $basketItem
             */
            $basketItem = $basketItemRepository->findOneBy([
                'basket' => $basket,
                'product' => $product
            ]);
            $entityManager->remove($basketItem);
            $entityManager->flush();
        } else {
            throw $this->createNotFoundException();
        }
        $content = $this->renderView('basket/items.html.twig', [
            'basketItems' => $basket->getBasketItems()
        ]);
        return $this->json([
            'count' => $basket->getBasketItems()->count(),
            'content' => $content,
            'total' => $basket->getTotal()
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

    /**
     * @Route("/basket", name="basket")
     * @param BasketFactory $factory
     * @return Response
     */
    public function basket(BasketFactory $factory): Response
    {
        $basket = $factory->getBasket();
        if (!$basket->getBasketItems()->count()) {
            return $this->redirectToRoute('index');
        }
        $productDeleteForm = $this->createForm(ProductDeleteFormType::class);
        return $this->render('basket/basket.html.twig', [
            'title' => 'Корзина',
            'basketItems' => $basket->getBasketItems(),
            'productDeleteForm' => $productDeleteForm->createView(),
            'cost' => $basket->getTotal(),
            'isReload' => true
        ]);
    }

    /**
     * @Route("/checkout", name="checkout")
     * @param BasketFactory $factory
     * @param OrderFactory $orderFactory
     * @param Request $request
     * @return Response
     */
    public function checkout(BasketFactory $factory, OrderFactory $orderFactory, Request $request): Response
    {
        $order = $orderFactory->getOrder();
        /**
         * @var OrderStatusRepository $defaultOrderStatusRepository
         */
        $defaultOrderStatusRepository = $this->getDoctrine()
            ->getManager()
            ->getRepository(OrderStatus::class);
        $order->setOrderStatus($defaultOrderStatusRepository->findDefault());
        $basket = $factory->getBasket();
        $orderForm = $this->createForm(OrderFormType::class, $order);
        $orderForm->handleRequest($request);
        if (!$basket->getBasketItems()->count()) {
            return $this->redirectToRoute('index');
        }
        if ($orderForm->isSubmitted() && $orderForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $sessionId = $request->getSession()->getId();
            $basket->setSessionId($sessionId);
            $basket->setIsActive(false);
            $entityManager->persist($basket);
            $entityManager->flush();
            $request->getSession()->migrate();
            return $this->redirectToRoute('index');
        }
        return $this->render('basket/checkout.html.twig', [
            'title' => 'Оформить заказ',
            'orderForm' => $orderForm->createView(),
            'basketItems' => $basket->getBasketItems(),
            'cost' => $basket->getTotal(),
        ]);
    }
}
