<?php

namespace App\Repository;

use App\Entity\RechercheStage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RechercheStage|null find($id, $lockMode = null, $lockVersion = null)
 * @method RechercheStage|null findOneBy(array $criteria, array $orderBy = null)
 * @method RechercheStage[]    findAll()
 * @method RechercheStage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RechercheStageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RechercheStage::class);
    }

    // /**
    //  * @return RechercheStage[] Returns an array of RechercheStage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RechercheStage
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
