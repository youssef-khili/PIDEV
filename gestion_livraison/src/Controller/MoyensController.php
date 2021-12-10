<?php

namespace App\Controller;

use App\Entity\Moyens;
use App\Form\MoyensType;
use App\Repository\MoyensRepository;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
//api qrcode
use App\Form\SearchType;
use App\Services\QrcodeService;
use App\Form\PropertySearchType;

class MoyensController extends AbstractController
{
    /**
     * @Route("/moyens", name="moyens")
     *
     */
    public function index(): Response
    {
        return $this->render('moyens/index.html.twig', [
            'controller_name' => 'MoyensController',
        ]);
    }

    /**
     * @return Response
     * @Route ("AfficheMoyen",name="AfficheMoyen")
     *
     */
    Public function Affiche(){
        $repo=$this->getDoctrine()->getRepository(Moyens::class);
        $moyens=$repo->findAll();
        return $this->render('moyens/Affiche.html.twig',
            ['moyens'=>$moyens]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     *
     */
    public function Delete($id): Response
    {
        $repo=$this->getDoctrine()->getRepository(Moyens::class);
        $moyens=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($moyens);
        $em->flush();
        return $this->redirectToRoute('AfficheMoyen');


    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/AddMoyen", name="AddMoyen")
     *
     */
    function Add(Request $request): Response
    {

        $moyens=new Moyens();
        $form=$this->createForm(MoyensType::class,$moyens);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($moyens);
            $em->flush();
            return $this->redirectToRoute('AfficheMoyen');
        }
        return $this->render('moyens/add.html.twig',[
            'form'=>$form->createView()
        ]);


    }
    /**
     * @Route ("/update/{id}", name="update")
     *
     */
    function Update($id,Request $request){
        $repo=$this->getDoctrine()->getRepository(Moyens::class);
        $moyens=$repo->find($id);
        $form=$this->createForm(MoyensType::class,$moyens);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('AfficheMoyen');
        }
        return $this->render('moyens/Update.html.twig',[
            'f'=>$form->createView()
        ]);

    }
    /**
     * @return Response
     * @Route ("Affichec",name="Affichec")
     *
     */
    Public function Affichec(){
        $repo=$this->getDoctrine()->getRepository(Moyens::class);
        $moyens=$repo->findAll();
        return $this->render('moyens/Affichec.html.twig',
            ['moyens'=>$moyens]);
    }

    /**
     * @Route("/qr", name="homepage")
     * @param Request $request
     * @param QrcodeService $qrcodeService
     * @return Response
     *
     */
    public function Qr(Request $request, QrcodeService $qrcodeService): Response
    {
        $qrCode = null;
        $form = $this->createForm(SearchType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $qrCode = $qrcodeService->qrcode($data['name']);
        }

        return $this->render('moyens/Qr.html.twig', [
            'form' => $form->createView(),
            'qrCode' => $qrCode
        ]);
    }

    /**
     * @Route("rechercherdeg", name="rechercherdeg")
     */
    public function RechercheDemandeDeg(Request $request ,MoyensRepository $repository)
    {
        $arrive=$request->get('search');
        $moyens = $repository->RechercheDemandeDeg($arrive );

        return $this->render('moyens/Affichec.html.twig', array("moyens" => $moyens));
    }
    /**
     * @Route("/orderByDegre", name="orderByDegre")
     */
    public function orderByDegre(MoyensRepository $repository)
    {

        $moyens=$repository->orderByDegre();
        return $this->render('moyens/Affichec.html.twig', [
            "moyens" => $moyens,
        ]);
    }
    /**
     * @Route("/orderByDegre2", name="orderByDegre2")
     */
    public function orderByDegre2(MoyensRepository $repository)
    {

        $moyens=$repository->orderByDegre2();
        return $this->render('moyens/Affichec.html.twig', [
            "moyens" => $moyens,
        ]);
    }




}