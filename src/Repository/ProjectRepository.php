<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Project>
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

       /**
        * @return Project[] Returns an array of Project objects
        */
       public function findAllProjects(): array
       {
           return $this->createQueryBuilder('p')
               ->select('p', 'c')
               ->leftJoin('p.category', 'c') // (p.category) Allows reducing SQL queries.
               ->getQuery()
               ->getResult()
           ;
       }

       /**
        *
        * @return Project[] Return an array of the first 3 projects.
        */
       public function countAllResultProject(): array
       {
           return $this->createQueryBuilder('p')
                ->select('p')
                ->orderBy('p.createdAt', 'ASC')
                ->setMaxResults(0)
                ->setMaxResults(3)
                ->getQuery()
                ->getResult()
               
           ;
       }
}
