<?php


namespace App\Form\DataTransformer;


use App\Entity\OrderStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class HiddenToOrderStatusEntityTransformer implements DataTransformerInterface
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
     * @param OrderStatus $value
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
     * @return OrderStatus|null
     */
    public function reverseTransform($value): ?OrderStatus
    {
        if (!$value) {
            return null;
        }

        /**
         * @var OrderStatus $orderStatus
         */
        $orderStatus = $this->entityManager
            ->getRepository(OrderStatus::class)
            ->find($value);

        if (null === $orderStatus) {
            throw new TransformationFailedException(sprintf(
                'An order status with number "%s" does not exist!',
                $value
            ));
        }

        return $orderStatus;
    }
}