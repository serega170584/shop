<?php


namespace App\Form\DataTransformer;


use App\Entity\BasketItem;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class HiddenToEntityTransformer implements DataTransformerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param BasketItem $value
     * @return string
     */
    public function transform($value): string
    {
        if (null === $value) {
            return '';
        }

        return $value->getId();
    }

    /**
     * @param mixed $value
     * @return BasketItem|null
     */
    public function reverseTransform($value): ?BasketItem
    {
        if (!$value) {
            return null;
        }

        /**
         * @var BasketItem $product
         */
        $product = $this->entityManager
            ->getRepository(Product::class)
            ->find($value);

        if (null === $product) {
            throw new TransformationFailedException(sprintf(
                'An product with number "%s" does not exist!',
                $value
            ));
        }

        return $product;
    }
}