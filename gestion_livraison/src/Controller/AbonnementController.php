<?php

namespace App\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Abonnement;
use App\Form\AbonnementType;
use App\Repository\AbonnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use MercurySeries\FlashyBundle\FlashyNotifier;
class AbonnementController extends AbstractController
{
    /**
     * @Route("/abonnement", name="abonnement")
     */
    public function index(): Response
    {
        return $this->render('abonnement/index.html.twig', [
            'controller_name' => 'AbonnementController',
        ]);
    }

    /**
     * @param AbonnementRepository $repository
     * @return  \Symfony\Component\HttpClient\Response
     * @Route("/AffichefrontAbonnement",name="AffichefrontAbonnement")
     */
    public function Affichef(AbonnementRepository $repository){
        $abonnement=$repository->findAll();
        return $this->render('abonnement/AffichefrontAbonnements.html.twig',
            ['abonnement'=>$abonnement]);
    }


    /**
     * @param AbonnementRepository $repository
     * @return  \Symfony\Component\HttpClient\Response
     * @Route("/AfficheAbonnement",name="AfficheAbonnement")
     */
    public function Affiche(AbonnementRepository $repository){
        $abonnement=$repository->findAll();
        return $this->render('abonnement/AfficheAbonnements.html.twig',
            ['abonnement'=>$abonnement]);
    }
    /**
     * @Route("/Supp/{id}", name="d")
     */
    function Delete($id, AbonnementRepository $repository){
        $abonnement=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($abonnement);
        $em->flush();
        return $this->redirectToRoute("AfficheAbonnement");
    }
    /**
     * @param AbonnementRepository $repository
     * @return  \Symfony\Component\HttpClient\Response
     * @Route("/abonnement/add",name="AjoutAbonnement")
     */
    function Add(Request $request,FlashyNotifier $flashy){
        $abonnement=new Abonnement();
        $form=$this->createForm(AbonnementType::class,$abonnement);
        /*$form->add('Ajouter', SubmitType::class);*/
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($abonnement);
            $em->flush();
            $flashy->message('offre created  ', 'http://your-awesome-link.com');
            return $this->redirectToRoute('AfficheAbonnement');
        }
        return $this->render('abonnement/AddAbonnement.html.twig',[
            'abonnement '=>$abonnement,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("abonnement/Update/{id}",name="update")
     */
    function Update(AbonnementRepository $repository,$id,Request $request){
        $abonnement=$repository->find($id);
        $form=$this->createForm(AbonnementType::class,$abonnement);
        $form->add('Update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('AfficheAbonnement');
        }
        return $this->render('abonnement/Update.html.twig',
            [
                'f'=>$form->createView()
            ]);
    }
    /**
     * @Route("/offre/ListQB",name="trie")
     */
    function OrderByMailQB(AbonnementRepository $repository,Request $request):Response
    {
        $offre = $repository->OrderByMailQB();


        return $this->render('abonnement/AfficheAbonnements.html.twig',['abonnement' =>$offre]);
    }
    /**
     * @Route("/imprimer/pdf", name="imprimer_index")
     */
    public function pdf(AbonnementRepository $abonnementRepository): Response

    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', "Gill Sans MT");

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $abonnement = $abonnementRepository->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('abonnement/pdf.html.twig', [
            'abonnements' =>  $abonnement,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("Liste abonnement.pdf", [
            "Attachment" => true
        ]);

    }
}
