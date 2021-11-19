<?php

namespace App\Controller;

use App\Entity\Pub;
use App\Form\PubType;
use App\Repository\PubRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface ;

class PubController extends AbstractController
{

    public function index(): Response
    {
        return $this->render('pub/Affiche.html.twig', [
            'controller_name' => 'PubController',
        ]);
    }

    /**
     * param PubRepository $repository
     * return \Symfony\Component\HttpFoundation\Response
     * @Route("pub/afficher",name="affichePub")
     */
    public function Afficher(PubRepository $repository)
    {
        $repository = $this->getDoctrine()->getRepository(Pub::class);
        $Pub = $repository->findAll();
        return $this->render('pub/Affiche.html.twig',
            ['Pub' => $Pub]);
    }

    /**
     * param Request $request
     * return \Symfony\Component\HttpFoundation\Response
     * @Route("pub/Add")
     */

    function Add(Request $request)
    {
        $Pub = new Pub();
        $form = $this->createForm(PubType::class, $Pub);
        $form->add('Ajouter', SubmitType::class);
        $form->handleRequest($request);// gerer la requete "handle": parcourir les requetes et retourner tous les chaps du form

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Pub);
            $em->flush();
            return $this->redirectToRoute('affichePub');
        }
        return $this->render('pub/Add.html.twig',
            [
                'form' => $form->createView()
            ]);


    }

    /**
     * @Route("Supprimer/{id}", name="D")
     */
    function Delete($id, PubRepository $repository)
    {
        $Pub = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Pub);
        $em->flush();
        return $this->redirectToRoute('affichePub');

    }

    /**
     * @Route("Update/{id}", name="Update")
     */
    function Update(PubRepository $repository, $id, Request  $request){
        $pub=$repository -> find($id);
        $form=$this->createForm(PubType::class,$pub);
        $form -> add('Update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form ->isValid()){
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute('affichePub');
        }
        return $this->render('pub/Update.html.twig',
            [
                'f'=>$form->createView()
            ]);


    }
    /**
     * param PubRepository $repository
     * return \Symfony\Component\HttpFoundation\Response
     * @Route("pub/afficher2",name="affichePub2")
     */
    public function Afficher2(PubRepository $repository)
    {
        $repository = $this->getDoctrine()->getRepository(Pub::class);
        $Pub = $repository->findAll();
        return $this->render('pub/Affiche2.html.twig',
            ['Pub' => $Pub]);
    }

}
