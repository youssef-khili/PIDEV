<?php

namespace App\Controller;

use App\Repository\ActualiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FronttController extends AbstractController
{
    /**
     * @Route("/frontt", name="frontt" )
     */
    public function index(ActualiteRepository $repository): Response
    {
        return $this->render('frontt/index.html.twig', [
            'actualites' => $repository->findAll(),
        ]);
    }
}
