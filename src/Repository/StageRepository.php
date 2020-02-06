<?php

namespace App\Repository;

use App\Entity\Stage;
use App\Entity\RechercheStage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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
    public function findAllVisibleQuery(RechercheStage $search)
    {
        $query = $this->createQueryBuilder('c');
        
        if ($search->getDateStage()) {
            $query = $query
                ->andWhere('c.date_debut = :dateStage')
                ->setParameter('dateStage', $search->getDateStage());                
            }

        if ($search->getEleveStage()) {
            $query = $query
                ->andWhere('c.eleve = :eleveStage')
                ->setParameter('eleveStage', $search->getEleveStage());
        }

        if ($search->getEntrepriseStage()) {
            $query = $query
                ->andWhere('c.entreprise = :entrepriseStage')
                ->setParameter('entrepriseStage', $search->getEntrepriseStage());
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
