<?php

namespace App\Controller;
use App\Entity\Actualite;
use App\Form\ActualiteType;

use App\Repository\ActualiteRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\All;

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
    
  /**
 * @var ActualiteRepository
 */
private $repository;

/**
     *@Route("/frontt/{slug}-{id}", name="frontt.showw",requirements={"slug":"[a-z0-9\-]*"} )
     * @return Response
     */
    public function showw(Actualite $actualite):Response{
        $actualite=$this->repository->find($id);
return $this->render('frontt/showw.html.twig',['actualite'=>$actualite,'current-menu'=>'actualite']);
    }
     

}

