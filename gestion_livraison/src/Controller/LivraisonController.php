<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Form\LivraisonType;
use App\Repository\LivraisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivraisonController extends AbstractController
{
    /**
     * @Route("/livraison", name="livraison")
     */
    public function index(): Response
    {
        return $this->render('livraison/index.html.twig', [
            'controller_name' => 'LivraisonController',
        ]);
    }
    /**
     * @param LivraisonRepository $repository
     * @return Response
     *@Route("/livraison/affiche_livraison",name="affichelivraison")
     */
    public function affiche_livraison(LivraisonRepository $repository){
        // $repo=$this->getDoctrine()->getRepository(Livraison::class );
        $livraison=$this->getDoctrine()->getRepository(livraison::class )->findAll();
        return $this->render('livraison/affiche_livraison.html.twig',
            ['livraison'=>$livraison]);
    }
    /**
     * @Route ("/supp/{id}",name="d")
     */
    function  Delete($id, LivraisonRepository $repository){
        $livraison = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($livraison);
        $em->flush();
        return $this->redirectToRoute('affichelivraison');
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/livraison/add")
     */
    public function add (Request $request): Response
    {
        $livraison = new livraison();
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($livraison);
            $em->flush();
            return $this->redirectToRoute('affichelivraison');
        }
        return $this->render('livraison/addl.html.twig',
            ['form' => $form->createView()]);

    }
    /**
     * @Route ("/livraison/Update/{id}" , name="update")
     */


    function Update(LivraisonRepository $repository , $id,Request $request) {
        $livraison=$repository->find($id);
        $form=$this->createForm(LivraisonType::class,$livraison);
        $form->add('Update', submitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("affichelivraison") ;
        }
        return  $this->render( 'livraison/Update.html.twig',['f'=>$form->createView()]);
    }
}
