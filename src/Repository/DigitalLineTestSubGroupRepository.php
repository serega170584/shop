<?php

namespace App\Repository;

use App\Entity\DigitalLineTestSubGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DigitalLineTestSubGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method DigitalLineTestSubGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method DigitalLineTestSubGroup[]    findAll()
 * @method DigitalLineTestSubGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DigitalLineTestSubGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DigitalLineTestSubGroup::class);
    }

    // /**
    //  * @return DigitalLineTestSubGroup[] Returns an array of DigitalLineTestSubGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DigitalLineTestSubGroup
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
