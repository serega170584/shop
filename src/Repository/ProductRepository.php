<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @return Product[]
     */
    public function findIsSlider()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.isSlider = :val')
            ->setParameter('val', true)
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Product[]|Collection
     */
    public function findPopular()
    {
        echo gettype($this->findBy(['isPopular' => true]));
        die('asd');
        return $this->findBy(['isPopular' => true]);
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.isPopular = :val')
//            ->setParameter('val', true)
//            ->orderBy('p.id', 'DESC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult();
    }
}
