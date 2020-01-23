<?php

namespace App\Repository;

use App\Entity\ActiviteEntreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ActiviteEntreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteEntreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteEntreprise[]    findAll()
 * @method ActiviteEntreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteEntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActiviteEntreprise::class);
    }

    // /**
    //  * @return ActiviteEntreprise[] Returns an array of ActiviteEntreprise objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ActiviteEntreprise
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
