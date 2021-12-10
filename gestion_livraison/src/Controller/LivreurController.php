<?php

namespace App\Controller;

use App\Entity\Livreur;
use App\Entity\PropertySearch;
use App\Form\LivreurType;
use App\Form\PropertySearchType;
use App\Repository\LivreurRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


use Symfony\Component\Routing\Annotation\Route;

class LivreurController extends AbstractController
{
    /**
     * @Route("/livreur", name="livreur")
     */
    public function index(): Response
    {
        return $this->render('livreur/index.html.twig', [
            'controller_name' => 'LivreurController',
        ]);
    }

    /**
     * @param LivreurRepository $repository
     * @return Response
     * @Route("/livreur/tri", name="livreurtri")
     */
    public function AfficheClubByNbPlace(LivreurRepository $repository)
    {
        $livreur = $this->getDoctrine()->getRepository(Livreur::class)->listlivByRate();

        return $this->render('livreur/affiche_livreur.html.twig', ['livreur' => $livreur]);
    }

    /**
     * @param LivreurRepository $repository
     * @return Response
     * @Route("/livreur/trii", name="livreurtrii")
     */
    public function AfficheClubByNbPlacee(LivreurRepository $repository)
    {
        $livreur = $this->getDoctrine()->getRepository(Livreur::class)->listlivByRatee();

        return $this->render('livreur/affiche_livreur.html.twig', ['livreur' => $livreur]);
    }


    /**
     * @param LivreurRepository $repository
     * @return Response
     *@Route("/livreur/affiche_livreur",name="affichelivreur")
     */
    public function affiche_livreur(LivreurRepository $repository){
       // $repo=$this->getDoctrine()->getRepository(Livreur::class );
        $livreur=$this->getDoctrine()->getRepository(livreur::class )->findAll();
        return $this->render('livreur/affiche_livreur.html.twig',
        ['livreur'=>$livreur]);
    }
    /**
     * @param LivreurRepository $repository
     * @return Response
     *@Route("/livreur/affiche_livreur_back",name="affichelivreurr")
     */
    public function affiche_livreur_back(LivreurRepository $repository){
        // $repo=$this->getDoctrine()->getRepository(Livreur::class );
        $livreur=$this->getDoctrine()->getRepository(livreur::class )->findAll();
        return $this->render('livreur/affiche_livreur_back.html.twig',
            ['livreur'=>$livreur]);
    }

    /**
     * @Route("/livreur/searchajax ", name="ajaxsearchlivreur")
     */
    public function searchMateriel(Request $request,LivreurRepository $liv)
    {
        $nom = $request->get('searchValue');
        $livreurs = $liv->livreurSearch($nom);
        return $this->render('livreur/search.html.twig', [
            "livreurs" => $livreurs
        ]) ;
    }

    /**
     * @Route ("/supp/{id}",name="d")
     */
    function  Delete($id, LivreurRepository $repository){
        $livreur = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($livreur);
        $em->flush();
        return $this->redirectToRoute('affichelivreur');
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/livreur/add")
     */
    public function add (Request $request ,MailerInterface $mailer ,FlashyNotifier $flashy): Response
    {
        $livreur = new livreur();
        $form = $this->createForm(LivreurType::class, $livreur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($livreur);
            $em->flush();

            $email = (new Email())
            ->From('mohameddhafer.ghedifi@esprit.tn')

            ->To('mohameddhafer.ghedifi@esprit.tn')
                ->subject('Nouveau livreur est ajouté')
                ->text('Recherche lui des livraisons et des suggestions')
                ->html('<p>Recherche lui des livraisons et des suggestions</p>');

            $mailer->send($email);

            //$this->addFlash('message','le message a ete enyoyer');
            $flashy->success('livreur ajouter','http://your-awesome-link.com');

            return $this->redirectToRoute('affichelivreur');
        }
        return $this->render('livreur/add.html.twig',
            ['form' => $form->createView()]);

    }


    /**
     * @Route("/livreur/listel", name="livreur_list", methods={"GET"})
     */
    public function liste(LivreurRepository  $livreurRepository,Request $request): Response
    {
        $session = $request->getSession();

        $name = $session->get('name');
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('livreur/pdf.html.twig', ['name' => $name,'livreur' => $livreurRepository->findAll(),]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", ["Attachment" => false]);
    }


    /**
     * @Route ("/livreur/Update/{id}" , name="update")
     */
    function Update(LivreurRepository $repository , $id,Request $request) {
        $livreur=$repository->find($id);
        $form=$this->createForm(LivreurType::class,$livreur);
        $form->add('Update', submitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("affichelivreur") ;
        }
        return  $this->render( 'livreur/Update.html.twig',['form'=>$form->createView()]);
    }


    /** @param LivreurRepository $repository
     * @return Response
     * @Route("/livreur/list", name="livreur__list")
     */
    public function home(LivreurRepository $repository, \Symfony\Component\HttpFoundation\Request $request): Response
    {
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);
        //initialement le tableau des articles est vide,
        //c.a.d on affiche les articles que lorsque l'utilisateur
        //clique sur le bouton rechercher
        $livreurs= [];

        if($form->isSubmitted() && $form->isValid()) {
            //on récupère le nom d'article tapé dans le formulaire

      $nom = $propertySearch->getNom();
       if ($nom!="")
     //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
      $livreurs= $this->getDoctrine()->getRepository(Livreur::class)->findBy(['nom' => $nom] );
       else
        //si si aucun nom n'est fourni on affiche tous les articles
     $livreurs= $this->getDoctrine()->getRepository(Livreur::class)->findAll();
 }
        return $this->render('livreur/search.html.twig',[ 'form' =>$form->createView(), 'livreur' => $livreurs]);
 }
}
