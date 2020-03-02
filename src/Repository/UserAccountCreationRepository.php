<?php

namespace App\Repository;

use App\Entity\UserAccountCreation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method UserAccountCreation|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAccountCreation|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAccountCreation[]    findAll()
 * @method UserAccountCreation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAccountCreationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserAccountCreation::class);
    }



  }
