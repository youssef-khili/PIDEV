<?php

namespace App\Controller;
use Symfony\Component\Mailer\Bridge\Google\Transport\GmailTransport;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Covoiturage;
use App\Repository\CovoiturageRepository;
use phpDocumentor\Reflection\Type;
use App\Form\CovoiturageType;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;

use Symfony\Component\Routing\Annotation\Route;

class CovoiturageController extends AbstractController
{
    /**
     * @Route("/covoiturage", name="covoiturage")
     */
    public function index(): Response
    {
        return $this->render('covoiturage/index.html.twig', [
            'controller_name' => 'CovoiturageController',
        ]);
    }
    /**
     * @param CovoiturageRepository $repository
     * @return Response
     * @Route("/covoiturage/affiche" , name="affiche" )
     */
    public function Affiche(CovoiturageRepository $repository)
    {
        $covoiturage = $this->getDoctrine()->getRepository(Covoiturage::class)->findAll();

        return $this->render('covoiturage/affiche.html.twig', ['covoiturage' => $covoiturage]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/covoiturage/add")
     */
    public function add(MailerInterface $mailer,Request $request,FlashyNotifier $flashy)
    {
        $covoiturage = new Covoiturage();
        $form = $this->createForm(CovoiturageType::class, $covoiturage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($covoiturage);
            $em->flush();
            $email  = (new  Email())
                ->From('farahyahyaoui0@gmail.com')
                ->To('farahyahyaoui0@gmail.com')
                ->subject('Time for Symfony Mailer!')
                ->text('Sending emails is fun again!')
                ->html('<p>See Twig integration for better HTML integration!</p>');

            $mailer->send($email);
            $flashy->success('covoiturage ajouté','http://your-awesome-link.com');


            return $this->redirectToRoute('affiche');
        }
        return $this->render('covoiturage/add.html.twig',
            ['form' => $form->createView()]);


    }

    /**
     * @Route ("/supp/{id}",name="d")
     */
    function Delete($id, CovoiturageRepository $repository)
    {
        $covoiturage = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($covoiturage);
        $em->flush();
        return $this->redirectToRoute('affiche');
    }

    /**
     * @Route ("/covoiturage/Update/{id}" , name="update")
     */

    function Update(CovoiturageRepository $repository, $id, Request   $request)
    {
        $covoiturage = $repository->find($id);
        $form = $this->createForm(CovoiturageType::class, $covoiturage);
        $form->add('Update', submitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute("affiche");

        }
        return $this->render('covoiturage/Update.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param CovoiturageRepository $repository
     * @return Response
     * @Route("/covoiturage/afficheback" , name="affiche2" )
     */
    public function Afficheback(CovoiturageRepository $repository)
    {
        $covoiturage = $this->getDoctrine()->getRepository(Covoiturage::class)->findAll();

        return $this->render('covoiturage/afficeback.html.twig', ['covoiturage' => $covoiturage]);
    }

    /**
     * @Route("/covoiturage/listel", name="covoiturage_list", methods={"GET"})
     */
    public function liste(CovoiturageRepository  $covoiturageRepository,Request $request): Response
    {
        $session = $request->getSession();

        $name = $session->get('name');
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf ($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('covoiturage/covoiturage.html.twig', ['name'=>$name,
            'covoiturage' => $covoiturageRepository->findAll(),

        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);


    }

    /**
     * @Route("/covoiturage/calendrier", name="calendrier")
     */
    public function calendrier(): Response
    {
        return $this->render('covoiturage/calendar.html.twig'
        );
    }
}
