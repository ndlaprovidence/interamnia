<?php

namespace App\Repository;

use App\Entity\RechercheEntreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RechercheEntreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method RechercheEntreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method RechercheEntreprise[]    findAll()
 * @method RechercheEntreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RechercheEntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RechercheEntreprise::class);
    }

    // /**
    //  * @return RechercheEntreprise[] Returns an array of RechercheEntreprise objects
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
    public function findOneBySomeField($value): ?RechercheEntreprise
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
