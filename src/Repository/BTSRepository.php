<?php

namespace App\Repository;

use App\Entity\BTS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BTS|null find($id, $lockMode = null, $lockVersion = null)
 * @method BTS|null findOneBy(array $criteria, array $orderBy = null)
 * @method BTS[]    findAll()
 * @method BTS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BTSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BTS::class);
    }

    // /**
    //  * @return BTS[] Returns an array of BTS objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BTS
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
