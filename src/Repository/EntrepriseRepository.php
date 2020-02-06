<?php

namespace App\Repository;

use App\Entity\Entreprise;
use App\Entity\RechercheEntreprise;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
    public function findAllVisibleQuery(RechercheEntreprise $search)
    {
        $query = $this->createQueryBuilder('e');
        
        if ($search->getNomEntreprise()) {
            $query = $query
                ->andWhere('e.nom = :nomEntreprise')
                ->setParameter('nomEntreprise', $search->getNomEntreprise());                
            }

        if ($search->getRegionEntreprise()) {
            $query = $query
                ->andWhere('e.region = :regionEntreprise')
                ->setParameter('regionEntreprise', $search->getRegionEntreprise());
        }

        if ($search->getVilleEntreprise()) {
            $query = $query
                ->andWhere('e.ville = :villeEntreprise')
                ->setParameter('villeEntreprise', $search->getVilleEntreprise());
        }
        
        return $query->getQuery()->getResult();
    }

    /**
     * @return Query
     */
    public function findDataOfCompany($entreprise)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT u.id, u.nom, u.prenom FROM App\Entity\User u JOIN App\Entity\Stage s JOIN App\Entity\Entreprise e WHERE u.id = :s.id AND s.entreprise = :e.id')->setParameter('entreprise', $entreprise);
        $users = $query->getResult();

        return $users;
    }

    // SELECT u.id, u.nom, u.prenom 
    // FROM tbl_user u JOIN tbl_stage s ON u.id = s.user_id JOIN tbl_entreprise e ON s.entreprise_id = e.id 
    // WHERE u.id = s.user_id AND s.entreprise_id = e.id 

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
