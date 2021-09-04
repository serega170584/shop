<?php

namespace App\Repository;

use App\Entity\TestSubGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TestSubGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestSubGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestSubGroup[]    findAll()
 * @method TestSubGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestSubGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestSubGroup::class);
    }

    // /**
    //  * @return TestSubGroup[] Returns an array of TestSubGroup objects
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
    public function findOneBySomeField($value): ?TestSubGroup
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
