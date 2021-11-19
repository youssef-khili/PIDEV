<?php

namespace App\Controller;

use App\Entity\Livreur;
use App\Form\LivreurType;
use App\Repository\LivreurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreurController extends AbstractController
{
    /**
     * @Route("/livreur", name="livreur")
     */
    public function index(): Response
    {
        return $this->render('livreur/index.html.twig', [
            'controller_name' => 'LivreurController',
        ]);
    }

    /**
     * @param LivreurRepository $repository
     * @return Response
     *@Route("/livreur/affiche_livreur",name="affichelivreur")
     */
    public function affiche_livreur(LivreurRepository $repository){
       // $repo=$this->getDoctrine()->getRepository(Livreur::class );
        $livreur=$this->getDoctrine()->getRepository(livreur::class )->findAll();
        return $this->render('livreur/affiche_livreur.html.twig',
        ['livreur'=>$livreur]);
    }
    /**
     * @Route ("/supp/{id}",name="d")
     */
    function  Delete($id, LivreurRepository $repository){
        $livreur = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($livreur);
        $em->flush();
        return $this->redirectToRoute('affichelivreur');
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/livreur/add")
     */
    public function add (Request $request): Response
    {
        $livreur = new livreur();
        $form = $this->createForm(LivreurType::class, $livreur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($livreur);
            $em->flush();
            return $this->redirectToRoute('affichelivreur');
        }
        return $this->render('livreur/addl.html.twig',
            ['form' => $form->createView()]);

    }
    /**
     * @Route ("/livreur/Update/{id}" , name="update")
     */


    function Update(LivreurRepository $repository , $id,Request $request) {
        $livreur=$repository->find($id);
        $form=$this->createForm(LivreurType::class,$livreur);
        $form->add('Update', submitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("affichelivreur") ;
        }
        return  $this->render( 'livreur/Update.html.twig',['f'=>$form->createView()]);
    }
}
