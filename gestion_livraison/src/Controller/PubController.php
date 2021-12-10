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
use Symfony\Component\Mailer\MailerInterface;
use App\api\MailerApi;

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
    // recherche
    /**
     * @Route("rechercherdeg", name="rechercherdeg")
     */
    public function RechercheDemandeDeg(Request $request ,PubRepository $repository)
    {
        $tarif=$request->get('search');
        $pub = $repository->RechercheDemandeDeg($tarif );

        return $this->render('pub/Affiche.html.twig', array("Pub" => $pub));
    }
    /**
     * @Route("/orderByDegre", name="orderByDegre")
     */
    public function orderByDegre(PubRepository $repository)
    {

        $pub = $repository->orderByDegre();
        return $this->render('pub/Affiche.html.twig', [
            "Pub" => $pub,
        ]);
    }


    /**
     * param Request $request
     * return \Symfony\Component\HttpFoundation\Response
     * @Route("pub/Add")
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */


    function Add(Request $request, MailerInterface $mailer)
    {
        $Pub = new Pub();
        $form = $this->createForm(PubType::class, $Pub);
        $form->add('Ajouter', SubmitType::class);
        $form->handleRequest($request);// gerer la requete "handle": parcourir les requetes et retourner tous les chaps du form

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Pub);
            $em->flush();


            $email = new MailerApi();
            $email->sendEmail( $mailer,'tunisport32@gmail.com','rahmaouijden.tagorti@esprit.tn','testing email','Publicité Créée avec success');

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
    function Del($id, PubRepository $repository)
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
                'form'=>$form->createView()
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
    /**
     * @Route("Supprimerr/{id}", name="Del")
     */
    function Delete_2($id, PubRepository $repository)
    {
        $Pub = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Pub);
        $em->flush();
        return $this->redirectToRoute('affichePub2');

    }
    /**
     * @Route("Upp/{id}", name="Upp")
     */
    function Update2(PubRepository $repository, $id, Request  $request){
        $pub=$repository -> find($id);
        $form=$this->createForm(PubType::class,$pub);
        $form -> add('Update2', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form ->isValid()){
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute('affichePub2');
        }
        return $this->render('pub/Update2.html.twig',
            [
                'form'=>$form->createView()
            ]);


    }
    /**
     * param Request $request
     * return \Symfony\Component\HttpFoundation\Response
     * @Route("pub/Add2")
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    function Add2(Request $request, MailerInterface $mailer)
    {
        $Pub = new Pub();
        $form = $this->createForm(PubType::class, $Pub);
        $form->add('Ajouter', SubmitType::class);
        $form->handleRequest($request);// gerer la requete "handle": parcourir les requetes et retourner tous les chaps du form

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Pub);
            $em->flush();


            $email = new MailerApi();
            $email->sendEmail( $mailer,'tunisport32@gmail.com','rahmaouijden.tagorti@esprit.tn','testing email','Publicité Créée avec success');

            return $this->redirectToRoute('affichePub2');

        }
        return $this->render('pub/Add2.html.twig',
            [
                'form' => $form->createView()
            ]);


    }



}
