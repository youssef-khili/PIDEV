<?php

namespace App\Repository;

use App\Entity\Actualite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Actualite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actualite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actualite[]    findAll()
 * @method Actualite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActualiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actualite::class);
    }

    // /**
    //  * @return Actualite[] Returns an array of Actualite objects
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
    public function findOneBySomeField($value): ?Actualite
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function OrderByDateQB(){
        return $this->createQueryBuilder('u')//select
           ->orderBy('u.date','ASC')
            ->getQuery()->getResult()
            ;

    }




    public function findAllPosts()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a
         FROM AppBundle:Post a
      
         ORDER BY a.posted_at DESC'
            )
            ->getArrayResult();
    }

    /**
     * get one by id
     *
     * @param integer $id
     *
     * @return array
     */
    public function findOneById($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT a, u.username
       FROM AppBundle:Annonce
       a JOIN a.user u
        WHERE a.id = id"
            )
            ->setParameter('id', $id)
            ->getArrayResult();
    }


    /**
     * get one by id
     *
     * @param integer $id
     *
     * @return object or null
     */
    public function findPostByid($id)
    {
        
            return $this->getEntityManager()
                ->createQuery(
                    "SELECT p
                FROM AppBundle:Post
                p WHERE p.id =:id"
                )
                ->setParameter('id', $id)
                ->getOneOrNullResult();
       
    }
    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM AppBundle:Post p
                WHERE p.title LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }
}

