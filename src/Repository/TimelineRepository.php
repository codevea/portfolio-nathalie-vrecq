<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Timeline;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Timeline>
 */
class TimelineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Timeline::class);
    }
    
        /**
        * @return Timeline[] Returns an array of Timeline objects
        */
        public function findAllTimelineAscDate(): array
        {
         return $this->createQueryBuilder('t')
             ->orderBy('t.date', 'DESC')
             ->getQuery()
             ->getResult()
             ;
        }

    //    /**
    //     * @return Timeline[] Returns an array of Timeline objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Timeline
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
