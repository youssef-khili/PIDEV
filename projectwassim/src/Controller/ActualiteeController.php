<?php

namespace App\Controller;

use App\Entity\Actualitee;
use App\Form\ActualiteeType;
use App\Repository\ActualiteeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Route("/actualitee")
 */
class ActualiteeController extends AbstractController
{
    /**
     * @Route("/", name="actualitee_index", methods={"GET"})
     */
    public function index(ActualiteeRepository $actualiteeRepository): Response
    {
        return $this->render('actualitee/index.html.twig', [
            'actualitees' => $actualiteeRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="actualitee_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $actualitee = new Actualitee();
        $form = $this->createForm(ActualiteeType::class, $actualitee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($actualitee);
            $entityManager->flush();

            return $this->redirectToRoute('actualitee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('actualitee/new.html.twig', [
            'actualitee' => $actualitee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="actualitee_show", methods={"GET"})
     */
    public function show(Actualitee $actualitee): Response
    {
        return $this->render('actualitee/show.html.twig', [
            'actualitee' => $actualitee,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="actualitee_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Actualitee $actualitee): Response
    {
        $form = $this->createForm(ActualiteeType::class, $actualitee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actualitee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('actualitee/edit.html.twig', [
            'actualitee' => $actualitee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="actualitee_delete", methods={"POST"})
     */
    public function delete(Request $request, Actualitee $actualitee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$actualitee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($actualitee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('actualitee_index', [], Response::HTTP_SEE_OTHER);
    }
}
