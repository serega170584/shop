<?php

namespace App\Repository;

use App\Entity\TestGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TestGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestGroup[]    findAll()
 * @method TestGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestGroup::class);
    }

    // /**
    //  * @return TestGroup[] Returns an array of TestGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TestGroup
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
