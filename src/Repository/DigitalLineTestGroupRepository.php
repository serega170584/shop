<?php

namespace App\Repository;

use App\Entity\DigitalLineTestGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DigitalLineTestGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method DigitalLineTestGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method DigitalLineTestGroup[]    findAll()
 * @method DigitalLineTestGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DigitalLineTestGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DigitalLineTestGroup::class);
    }

    // /**
    //  * @return DigitalLineTestGroup[] Returns an array of DigitalLineTestGroup objects
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
    public function findOneBySomeField($value): ?DigitalLineTestGroup
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
