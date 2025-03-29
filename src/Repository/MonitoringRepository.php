<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Monitoring;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Monitoring>
 */
class MonitoringRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Monitoring::class);
    }

       /**
        * @return Monitoring[] Returns an array of Monitoring objects
        */
       public function findAllMonitoring(): array
       {
           return $this->createQueryBuilder('t')
               ->getQuery()
               ->getResult()
           ;
       }

    //    public function findOneBySomeField($value): ?Monitoring
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
