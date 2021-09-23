<?php


namespace App\Domain\FormManager;


use App\Domain\FormPreloadInterface;
use App\Domain\SubjectManager\BasketManager;
use App\Entity\Product;
use App\Form\ProductAddFormType;
use App\Repository\BasketItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProductAddFormManager extends AbstractFormManager implements FormPreloadInterface
{
    /**
     * @var BasketManager
     */
    private $basketManager;
    /**
     * @var \App\Entity\Basket
     */
    private $basket;
    /**
     * @var BasketItemRepository
     */
    private $basketItemRepository;

    public function __construct(FormFactoryInterface $formFactory,
                                SessionInterface $session,
                                EntityManagerInterface $objectManager,
                                BasketManager $basketManager,
                                BasketItemRepository $basketItemRepository
    )
    {
        parent::__construct($formFactory, $session, $objectManager, ProductAddFormType::class);
        $this->basketManager = $basketManager;
        $this->basketItemRepository = $basketItemRepository;
    }

    public function preload(): self
    {
        $this->basketManager->inflate();
        $this->basket = $this->basketManager->getBasket();
        return $this;
    }

    public function handle(): self
    {
        $entityManager = $this->objectManager;
        $basket = $this->basket;
        $basket->setSessionId($this->session->getId());
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