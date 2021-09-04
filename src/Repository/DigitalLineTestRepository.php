<?php

namespace App\Repository;

use App\Entity\DigitalLineTest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DigitalLineTest|null find($id, $lockMode = null, $lockVersion = null)
 * @method DigitalLineTest|null findOneBy(array $criteria, array $orderBy = null)
 * @method DigitalLineTest[]    findAll()
 * @method DigitalLineTest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DigitalLineTestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DigitalLineTest::class);
    }

    // /**
    //  * @return DigitalLineTest[] Returns an array of DigitalLineTest objects
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
    public function findOneBySomeField($value): ?DigitalLineTest
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
