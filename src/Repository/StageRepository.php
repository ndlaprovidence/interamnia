<?php

namespace App\Repository;

use App\Entity\Stage;
use App\Entity\RechercheStage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use DoctrineExtensions\Query\Mysql;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    /**
     * @return Query
     */
    public function findAllVisibleQuery(RechercheStage $search, string $orderBy = NULL)
    {
        $emConfig = $this->getEntityManager()->getConfiguration();
        $emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
        $emConfig->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');
        $emConfig->addCustomDatetimeFunction('DAY', 'DoctrineExtensions\Query\Mysql\Day');

        $query = $this->createQueryBuilder('s');

        $query->join(
            'App\Entity\User',
            'u',
            'WITH',
            'u.id = s.user'
        );

        $query->join(
            'App\Entity\BTS',
            'b',
            'WITH',
            'b.id = s.bts'
        );

        if ($search->getDateStage()) {
            $query = $query
                ->andWhere('YEAR(s.date_debut) = :dateStage')
                ->setParameter('dateStage', $search->getDateStage());
        }

        if ($search->getEleveStage()) {
            $query = $query
                ->andWhere('u.nom LIKE :eleveStage')
                ->setParameter('eleveStage', '%' . $search->getEleveStage() . '%');
        }

        if ($search->getBtsStage()) {
            $query = $query
                ->andWhere('b.nom LIKE :btsStage') 
                ->setParameter('btsStage', '%' . $search->getBtsStage() . '%');
        }

        if (isset($orderBy)) {
            $query->orderBy($orderBy, 'ASC');
        }
        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
