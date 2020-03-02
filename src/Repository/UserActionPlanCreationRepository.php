<?php

namespace App\Repository;

use App\Entity\UserActionPlanCreation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserActionPlanCreation|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserActionPlanCreation|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserActionPlanCreation[]    findAll()
 * @method UserActionPlanCreation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserActionPlanCreationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserActionPlanCreation::class);
    }

    // /**
    //  * @return UserActionPlanCreation[] Returns an array of UserActionPlanCreation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserActionPlanCreation
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
