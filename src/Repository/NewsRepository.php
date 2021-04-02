<?php

namespace App\Repository;

use App\Entity\News;
use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

    /**
     * @return News[]
     */
    public function findLastRows($count = null)
    {
        $builder = $this->createQueryBuilder('news');
        if ($count) {
            $builder->setMaxResults($count);
        }
        return $builder
            ->orderBy('news.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

}
