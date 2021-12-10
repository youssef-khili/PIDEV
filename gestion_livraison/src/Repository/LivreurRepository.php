<?php

namespace App\Repository;

use App\Entity\Livreur;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method Livreur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livreur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livreur[]    findAll()
 * @method Livreur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreurRepository extends ServiceEntityRepository
{
        public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livreur::class);
    }

    // /**
    //  * @return Livreur[] Returns an array of Livreur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livreur
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function listlivByRate()
    {
        return $this->createQueryBuilder('l')
            ->orderBy('l.rate', 'ASC')
            ->getQuery()
            ->getResult();

    }

    public function listlivByRatee()
    {
        return $this->createQueryBuilder('l')
            ->orderBy('l.rate', 'DESC')
            ->getQuery()
            ->getResult();

    }


    public function livreurSearch(Request $request)
    {
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);

        $livreurs= [];

        if($form->isSubmitted() && $form->isValid()) {


            $nom = $propertySearch->getNom();
            if ($nom!="")
                //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
                $livreurs= $this->getDoctrine()->getRepository(Livreur::class)->findBy(['nom' => $nom] );
            else
                //si si aucun nom n'est fourni on affiche tous les articles
                $livreurs= $this->getDoctrine()->getRepository(Livreur::class)->findAll();
        }
        return $this->render('livreur/search.html.twig',[ 'form' =>$form->createView(), 'livreur' => $livreurs]);
    }


}
