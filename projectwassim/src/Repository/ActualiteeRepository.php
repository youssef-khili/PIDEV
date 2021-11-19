<?php

namespace App\Repository;

use App\Entity\Actualitee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Actualitee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actualitee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actualitee[]    findAll()
 * @method Actualitee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActualiteeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actualitee::class);
    }

    // /**
    //  * @return Actualitee[] Returns an array of Actualitee objects
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
    public function findOneBySomeField($value): ?Actualitee
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
