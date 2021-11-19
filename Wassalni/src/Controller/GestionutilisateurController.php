<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\UtilisateurRepository;
use App\Form\UtilisateurType;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Routing\Annotation\Route;


class GestionutilisateurController extends AbstractController
{
    /**
     * @Route("/gestionutilisateur", name="gestionutilisateur")
     */
    public function index(): Response
    {
        return $this->render('gestionutilisateur/index.html.twig', [
            'controller_name' => 'GestionutilisateurController',
        ]);
    }

    /**
     * @Route("/frontt", name="i")
     */

    public function indexx(): Response
    {
        return $this->render('templates/fronttemp.html.twig', [
            'controller_name' => 'GestionutilisateurController',
        ]);
    }

    /**
     * @param UtilisateurRepository $repository
     * @return Response
     * @Route("/AfficheU",name="aff")
     */

    public function Affiche(){
        $repo=$this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateur=$repo->findAll();
        return $this->render('gestionutilisateur/Affiche.html.twig',['utilisateur'=>$utilisateur]);
    }

    /**
     * @Route("/Supp/{idUser}",name="d")
     */
    function Delete($idUser){
        $repo=$this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateur=$repo->find($idUser);
        $em=$this->getDoctrine()->getManager();
        $em->remove($utilisateur);
        $em->flush();
        return $this->redirectToRoute('aff');

    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     * @Route("utilisateur/Add")
     */



    function Add(\Symfony\Component\HttpFoundation\Request $request){
        $utilisateur=new Utilisateur();
        $form=$this->createForm(UtilisateurType::class,$utilisateur);
        $form->add('Ajouter utilisateur',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();
            return $this->redirectToRoute('aff');

        }
        return $this->render('gestionutilisateur/Add.html.twig',['form'=>$form->createView()]);




    }
    /**
     * @Route("utilisateur/Update/{idUser}",name="update")
     */
    function Update(\Symfony\Component\HttpFoundation\Request $request,$idUser){
        $repo=$this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateur=$repo->find($idUser);
        $form=$this->createForm(UtilisateurType::class,$utilisateur);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("aff");
        }
        return $this->render('gestionutilisateur/update.html.twig',['form'=>$form->createView()]);

    }
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     * @Route("/inscrip","name=ii")
     */


    function Inscrip(\Symfony\Component\HttpFoundation\Request $request){
        $utilisateur=new Utilisateur();
        $form=$this->createForm(UtilisateurType::class,$utilisateur);
        $form->add('Sinscrire',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();
            return $this->redirectToRoute('aff');

        }
        return $this->render('gestionutilisateur/inscrip.html.twig',['form'=>$form->createView()]);




    }


}
