<?php

namespace App\Repository;

use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicule[]    findAll()
 * @method Vehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
    }

    // /**
    //  * @return Vehicule[] Returns an array of Vehicule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vehicule
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function listVehByNbPlace()
    {
        return $this->createQueryBuilder('v')
            ->orderBy('v.nb_place', 'ASC')
            ->getQuery()
            ->getResult();

    }

    public function findByPlaceRange($minValue, $maxValue)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.nb_place >= :minVal')
            ->setParameter('minVal', $minValue)
            ->andWhere('a.nb_place <= :maxVal')
            ->setParameter('maxVal', $maxValue)
            ->orderBy('v.id_veh', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;


    }




    public function tridesc()
        {
            return $this->createQueryBuilder('v')
                ->orderBy('v.nb_place', 'DESC')
                ->getQuery()
                ->getResult();

        }

}