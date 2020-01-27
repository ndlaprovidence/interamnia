<?php

namespace App\Repository;

use App\Entity\CompteRendu;
use App\Entity\RechercheStage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CompteRendu|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteRendu|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteRendu[]    findAll()
 * @method CompteRendu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteRenduRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteRendu::class);
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

    /**
     * @return Query
     */
    public function findDataOfStudent()
    {
        $query = $entityManager->createQuery(
            
        );

        return $query->getOneOrNullResult();
    }

    /**
     * @return Query
     */
    public function findDataOfCompany()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c.eleve
            FROM App\Entity\CompteRendu c
            INNER JOIN c.entreprise e
            WHERE c.entreprise = :entreprise'
        );

        return $query->getOneOrNullResult();
    }

    // /**
    //  * @return CompteRendu[] Returns an array of CompteRendu objects
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
    public function findOneBySomeField($value): ?CompteRendu
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
