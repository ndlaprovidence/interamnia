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

    /**
     * @return Query
     */
    public function findDataOfUser($id)
    {
            $query = $this->createQueryBuilder('u')
            ->select('e.id, e.nom, e.region, e.ville, s.date_debut, s.date_fin, s.theme')
            ->join(
                'App\Entity\Stage',
                's',
                'WITH',
                'u.id = s.user'
            )
            ->join(
                'App\Entity\Entreprise',
                'e',
                'WITH',
                'e.id = s.entreprise'
            )
            ->andWhere('u.id = :u_id')
            ->setParameter('u_id', $id);
            // ->setMaxResults(10)
            
            return $query->getQuery()->getResult();
    }

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
