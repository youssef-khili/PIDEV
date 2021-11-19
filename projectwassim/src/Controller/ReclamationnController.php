<?php

namespace App\Controller;

use App\Entity\Reclamationn;
use App\Form\ReclamationnType;
use App\Repository\ReclamationnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reclamationn")
 */
class ReclamationnController extends AbstractController
{
    /**
     * @Route("/", name="reclamationn_index", methods={"GET"})
     */
    public function index(ReclamationnRepository $reclamationnRepository): Response
    {
        return $this->render('reclamationn/index.html.twig', [
            'reclamationns' => $reclamationnRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="reclamationn_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reclamationn = new Reclamationn();
        $form = $this->createForm(ReclamationnType::class, $reclamationn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamationn);
            $entityManager->flush();

            return $this->redirectToRoute('reclamationn_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamationn/new.html.twig', [
            'reclamationn' => $reclamationn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reclamationn_show", methods={"GET"})
     */
    public function show(Reclamationn $reclamationn): Response
    {
        return $this->render('reclamationn/show.html.twig', [
            'reclamationn' => $reclamationn,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reclamationn_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reclamationn $reclamationn): Response
    {
        $form = $this->createForm(ReclamationnType::class, $reclamationn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamationn_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamationn/edit.html.twig', [
            'reclamationn' => $reclamationn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reclamationn_delete", methods={"POST"})
     */
    public function delete(Request $request, Reclamationn $reclamationn): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamationn->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reclamationn);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reclamationn_index', [], Response::HTTP_SEE_OTHER);
    }
}
