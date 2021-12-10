<?php

namespace App\Controller;
use App\Entity\PlaceSearch;
use App\Entity\PropertySearch2;
use Symfony\Component\HttpKernel\Kernel;
use App\Entity\Vehicule;
use App\Form\PlaceSearchType;
use App\Form\PropertySearchType2;
use App\Repository\VehiculeRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class VehiculeController extends AbstractController
{
    /**
     * @Route("/vehicule", name="vehicule")
     */
    public function index(): Response
    {
        return $this->render('vehicule/index.html.twig', [
            'controller_name' => 'VehiculeController',
        ]);
    }

    /**
     * @param VehiculeRepository $repository
     * @return Response
     * @Route("/vehicule/tri", name="vehiculetriD")
     */
    public function AfficheClubByNbPlace(VehiculeRepository $repository)
    {
        $vehicule = $this->getDoctrine()->getRepository(vehicule::class)->tridesc();

        return $this->render('vehicule/affichevehicule.html.twig', ['vehicule' => $vehicule]);
    }

    /**
     * @param VehiculeRepository $repository
     * @return Response
     * @Route("/vehicule/trii", name="vehiculetriiA")
     */
    public function AfficheClubByNbPlacee(VehiculeRepository $repository )
    {
        $vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->listVehByNbPlace();

        return $this->render('vehicule/affichevehicule.html.twig', ['vehicule' => $vehicule]);
    }


    /**
     * @param VehiculeRepository $repository
     * @return Response
     *@Route("/vehicule/affiche_vehiculee",name="afficheveh")
     */
    public function affiche_vehicule (VehiculeRepository $repository){
        // $repo=$this->getDoctrine()->getRepository(vehicule::class );
        $vehicule=$this->getDoctrine()->getRepository(vehicule::class )->findAll();
        return $this->render('vehicule/affichevehicule.html.twig', ['vehicule' => $vehicule]);
    }

    /**
     * @param VehiculeRepository $repository
     * @return Response
     *@Route("/vehicule/afficheback_vehiculee",name="affichevehh")
     */
    public function affiche_vehiculeback (VehiculeRepository $repository){
        // $repo=$this->getDoctrine()->getRepository(vehicule::class );
        $vehicule=$this->getDoctrine()->getRepository(vehicule::class )->findAll();
        return $this->render('vehicule/affichevehiculeback.html.twig', ['vehicule' => $vehicule]);
    }





    /**
     * @Route("/vehicule/addv", name="vehiculeadd")
     */
    public function addveh(): Response
    {
        return $this->render('vehicule/addv.html.twig', [
            'controller_name' => 'VehiculeController',
        ]);
    }

    /* /**
        * @Route("/vehicule/search", name="search_car")
        */
    /* public function search(): Response
     {
         $searchcarform = $this->createFormBuilder(SearchFormType::class)->getForm();
         return $this->render('vehicule/affichevehicule.html.twig',
             ['search_form' => $searchcarform->createView()]);
     }
 /*
     /**
      * * @param VehiculeRepository $repository
      * @return Response
      * @Route("/vehicule/recherche", name="vehicule_ list")
      */
    public function list_veh(VehiculeRepository $repository, \Symfony\Component\HttpFoundation\Request $request): Response
    {
        $propertySearch = new PropertySearch2();
        $form = $this->createForm(PropertySearchType2::class, $propertySearch);
        $form->handleRequest($request);
        //initialement le tableau des articles est vide,
        //c.a.d on affiche les articles que lorsque l'utilisateur
        //clique sur le bouton rechercher
        $vehicules = [];

        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère le nom d'article tapé dans le formulaire
            $type = $propertySearch->getType();
            if ($type != "")
                //si on a fourni un type d'article on affiche tous les articles ayant ce nom
                $vehicules = $this->getDoctrine()->getRepository(Vehicule::class) ->findBy(['type' => $type]);
            else
                //si si aucun nom n'est fourni on affiche tous les articles

                $vehicules = $this->getDoctrine()->getRepository(Vehicule::class)->listVehByNbPlace();
        }
        return $this->render('vehicule/afficev.html.twig', ['form' => $form ->createView(), 'vehicules' => $vehicules]);

    }
    /**
     * @Route("/vehicule/art_nbplace", name="article_par_nbplace")
     * Method({"GET"})
     */
    public function articlesParNbPlace(\Symfony\Component\HttpFoundation\Request $request)
    {

        $nbplaceSearch = new PlaceSearch();
        $form = $this->createForm(PlaceSearchType::class,$nbplaceSearch);
        $form->handleRequest($request);
        $vehicules= [];
        if($form->isSubmitted() && $form->isValid()) {
            $minnbplace = $nbplaceSearch->getMinnbplace();
            $maxnbplace = $nbplaceSearch-> getMaxnbplace();

            $vehicules= $this->getDoctrine()->
            getRepository(Vehicule::class)->findByPlaceRange($minnbplace,$maxnbplace);
        }
        return $this->render('vehicule/afficev.html.twig',[ 'form' =>$form->createView(), 'vehicules' => $vehicules]);
    }



}
