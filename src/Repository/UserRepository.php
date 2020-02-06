<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return Query
    //  */
    // public function findDataOfStudent($entreprise)
    // {
    //     $em = $this->getEntityManager();

    //     $query = $em->createQuery( // Comment sélectionner les élèves depuis l'entité entreprise ?
    //         'SELECT IDENTITY (c.user)
    //         FROM App\Entity\Stage c
    //         INNER JOIN c.entreprise e
    //         WHERE c.entreprise = :entreprise'
    //     )->setParameter('entreprise', $entreprise);

    //     return $query->getResult();
    // }

    // SELECT e.id, e.nom, e.region, e.ville, s.date_debut, s.date_fin, s.theme 
    // FROM tbl_entreprise e JOIN tbl_stage s ON e.id = s.entreprise_id JOIN tbl_user u ON s.user_id = u.id 
    // WHERE e.id = s.entreprise_id AND s.user_id = u.id 

    // /**
    //  * @return User[] Returns an array of User objects
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
    public function findOneBySomeField($value): ?User
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
