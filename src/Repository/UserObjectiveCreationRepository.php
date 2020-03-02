<?php

namespace App\Repository;

use App\Entity\UserObjectiveCreation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserObjectiveCreation|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserObjectiveCreation|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserObjectiveCreation[]    findAll()
 * @method UserObjectiveCreation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserObjectiveCreationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserObjectiveCreation::class);
    }

    // /**
    //  * @return UserObjectiveCreation[] Returns an array of UserObjectiveCreation objects
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
    public function findOneBySomeField($value): ?UserObjectiveCreation
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
