<?php


namespace App\Domain\FormManager;


use App\Domain\FormPreloadInterface;
use App\Domain\SubjectManager\BasketManager;
use App\Entity\Product;
use App\Form\ProductAddFormType;
use App\Repository\BasketItemRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductAddFormManager extends AbstractFormManager implements FormPreloadInterface
{
    /**
     * @var BasketManager
     */
    private $basketManager;
    /**
     * @var string
     */
    private $sessionId;
    /**
     * @var \App\Entity\Basket
     */
    private $basket;
    /**
     * @var BasketItemRepository
     */
    private $basketItemRepository;

    public function __construct(FormFactoryInterface $formFactory,
                                Request $request,
                                ObjectManager $objectManager,
                                BasketManager $basketManager,
                                BasketItemRepository $basketItemRepository
    )
    {
        parent::__construct($formFactory, $request, $objectManager, ProductAddFormType::class);
        $this->basketManager = $basketManager;
        $this->basketItemRepository = $basketItemRepository;
    }

    public function preload(): self
    {
        $this->sessionId = $this->request->getSession()->getId();
        $this->basket = $this->basketManager->getBasket();
    }

    public function handle(): self
    {
        $entityManager = $this->objectManager;
        $basket = $this->basket;
        $basket->setSessionId($this->sessionId);
        $basket->setIsActive(true);
        $entityManager->persist($basket);
        $entityManager->flush();
        $productRepository = $this->objectManager
            ->getRepository(Product::class);
//        $basketItem = $entityManager->getRepository(BasketItemRepository::class);
        $basketItemRepository = $this->basketItemRepository;
        $basketItem = $basketItemRepository->createEntity();
        /**
         * @var Product $product
         */
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
        return $this;
    }
}