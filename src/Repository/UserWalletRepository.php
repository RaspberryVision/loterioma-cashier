<?php

namespace App\Repository;

use App\Entity\UserWallet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserWallet|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserWallet|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserWallet[]    findAll()
 * @method UserWallet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserWalletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserWallet::class);
    }

    // /**
    //  * @return UserWallet[] Returns an array of UserWallet objects
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
    public function findOneBySomeField($value): ?UserWallet
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
