<?php

namespace App\Repository;

use App\Entity\UserEnergyValuesCreation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserEnergyValuesCreation|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserEnergyValuesCreation|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserEnergyValuesCreation[]    findAll()
 * @method UserEnergyValuesCreation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserEnergyValuesCreationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEnergyValuesCreation::class);
    }

    // /**
    //  * @return UserEnergyValuesCreation[] Returns an array of UserEnergyValuesCreation objects
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
    public function findOneBySomeField($value): ?UserEnergyValuesCreation
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
