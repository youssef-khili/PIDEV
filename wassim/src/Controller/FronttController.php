<?php

namespace App\Controller;
use App\Entity\Actualite;
use App\Form\ActualiteType;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repository\ActualiteRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\HttpFoundation\Request;

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
          * @Route("/list",name="actualite_list",methods={"GET"})
          */
          public function listP(ActualiteRepository $actualiteRepository)
          {
            $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $actualite=$actualiteRepository->findAll();
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('frontt/listP.html.twig', [
            'actualites' => $actualite,
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);






            
    
    }

  
   /**
     * @param ActualiteRepository $repository
     * @return Response
     * @Route ("/ListQB",name="ListQB")
     */
    public function OrderByDateQB(ActualiteRepository $repository){
        $actualite=$repository->OrderByDateQB();
        return $this->render('frontt/index.html.twig',
        ['actualites'=>$actualite]);


}


}


