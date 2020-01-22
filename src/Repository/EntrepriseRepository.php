<?php

namespace App\Repository;

use App\Entity\Entreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Entreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entreprise[]    findAll()
 * @method Entreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entreprise::class);
    }

    /**
     * @return Query
     */
    public function findAllVisibleQuery(Entreprise $search): Query
    {
        $query = $this->findVisibleQuery();
        
        if ($search->getNomEntreprise()) {
            $query = $query
                ->where('e.nom = :nomEntreprise')
                ->setParameter('nomEntreprise', $search->getNomEntreprise());
        }

        if ($search->getRegionEntreprise()) {
            $query = $query
                ->where('e.region = :regionEntreprise')
                ->setParameter('regionEntreprise', $search->getRegionEntreprise());
        }

        if ($search->getVilleEntreprise()) {
            $query = $query
                ->where('e.ville = :villeEntreprise')
                ->setParameter('villeEntreprise', $search->getVilleEntreprise());
        }
        
        return $query->getQuery();
    }

    // /**
    //  * @return Entreprise[] Returns an array of Entreprise objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Entreprise
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
