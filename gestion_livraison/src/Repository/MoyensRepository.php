<?php

namespace App\Repository;

use App\Entity\Moyens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Moyens|null find($id, $lockMode = null, $lockVersion = null)
 * @method Moyens|null findOneBy(array $criteria, array $orderBy = null)
 * @method Moyens[]    findAll()
 * @method Moyens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoyensRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Moyens::class);
    }
    public function RechercheDemandeDeg($arrive){
        return $this->createQueryBuilder('m')
            ->where('m.arrive LIKE :arrive')


            ->setParameter('arrive', '%' .$arrive. '%')

            ->getQuery()
            ->getResult();
    }
    public function orderByDegre()
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.tarif', 'ASC')
            ->getQuery()->getResult();
    }
    public function orderByDegre2()
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.tarif', 'DESC')
            ->getQuery()->getResult();
    }

    // /**
    //  * @return Moyens[] Returns an array of Moyens objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Moyens
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
