<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\UtilisateurRepository;
use App\Form\UtilisateurType;
use http\Env\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;






class GestionutilisateurController extends AbstractController
{
    /**
     * @Route("/gestionutilisateur", name="gestionutilisateur")
     */
    public function index(): Response
    {
        return $this->render('gestionutilisateur/index.html.twig', [
            'controller_name' => 'GestionutilisateurController',
        ]);
    }

    /**
     * @return Response
     * @Route("/fronttt", name="fronto")
     */

    public function indexxx(): Response
    {
        return $this->render('gestionutilisateur/frontofiice.html.twig',['controller_name'=>'gestionutilisateur']);
    }
    /**
     * @return Response
     * @Route("/backk", name="backo")
     */

    public function index2(): Response
    {
        return $this->render('gestionutilisateur/backoff.html.twig',['controller_name'=>'gestionutilisateur']);
    }

    /**
     * @Route("/frontt", name="i")
     */

    public function indexx(): Response
    {
        return $this->render('templates/fronttemp.html.twig', [
            'controller_name' => 'GestionutilisateurController',
        ]);
    }

    /**
     * @param \App\Repository\UtilisateurRepository $repository
     * @return Response
     * @Route("/AfficheU",name="aff")
     */

    public function Affiche(){
        $repo=$this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateur=$repo->findAll();
        return $this->render('gestionutilisateur/Affiche.html.twig',['utilisateur'=>$utilisateur]);
    }

    /**
     * @Route("/Supp/{idUser}",name="ddd")
     */
    function Delete($idUser){
        $repo=$this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateur=$repo->find($idUser);
        $em=$this->getDoctrine()->getManager();
        $em->remove($utilisateur);
        $em->flush();
        return $this->redirectToRoute('aff');

    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     * @Route("utilisateur/Add")
     */



    function Add(\Symfony\Component\HttpFoundation\Request $request, FlashyNotifier $flashy){
        $utilisateur=new Utilisateur();
        $form=$this->createForm(UtilisateurType::class,$utilisateur);
        $form->add('Ajouter utilisateur',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();
            $flashy->success('ajout avec succes','http://your-awesome-link.com');
            return $this->redirectToRoute('aff');

        }
        return $this->render('gestionutilisateur/Add.html.twig',['form'=>$form->createView()]);




    }
    /**
     * @Route("utilisateur/Update/{idUser}",name="updatee")
     */
    function Update($idUser,\Symfony\Component\HttpFoundation\Request $request){
        $repo=$this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateur=$repo->find($idUser);
        $form=$this->createForm(UtilisateurType::class,$utilisateur);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("aff");
        }
        return $this->render('gestionutilisateur/update.html.twig',['form'=>$form->createView()]);

    }
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     * @Route("/inscrip",name="ii")
     */


    function Inscrip(\Symfony\Component\HttpFoundation\Request $request){
        $utilisateur=new Utilisateur();
        $form=$this->createForm(UtilisateurType::class,$utilisateur);

        $form->add('Sinscrire',SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice','Inscription faite avec succes');

        }
        return $this->render('gestionutilisateur/inscrip.html.twig',['form'=>$form->createView()]);




    }





    /**
     * @Route("/login",name="logg")
     */

    function login(\Symfony\Component\HttpFoundation\Request $request):Response
    {
        $utilisateur=new Utilisateur();
        $utilisateur->setCout(25);
        $utilisateur->setEmail("shsghsh");
        $utilisateur->setDepart("dgjndgj");
        $utilisateur->setDestination("fgjdjg");
        $utilisateur->setNumTel(25478963);
        $utilisateur->setTypeService("dgjdgjd");
        $utilisateur->setNomUser("dfgjdgj");
        $utilisateur->setPrenomUser("dgndgjdgj");
        $utilisateur->setRole("ADMIN");
        $form=$this->createFormBuilder($utilisateur)
            ->add('username',TextType::class)
            ->add('password',PasswordType::class)
            #->add('Login',SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $pwd=$utilisateur->getPassword();
            $username=$utilisateur->getUsername();
            $repository=$this->getDoctrine()->getRepository(Utilisateur::class);
            $utilisateur1=$repository->findOneBy(array('username'=>$username,'password'=>$pwd));
            if($utilisateur1){
                if ($utilisateur1->getRole()=="ADMIN"){
                    return $this->redirect('backo');

                }

                else{
                    return $this->redirect('fronto');
                }
            }
        }
        return $this->render('gestionutilisateur/loginn.html.twig',['utilisateur'=>$utilisateur,'form'=>$form->createView()]);
    }

    /**
     * @param \App\Repository\UtilisateurRepository $repository
     * @return Response
     * @Route("/tri" , name="tri")
     */


    function OrderByNom_user(\App\Repository\UtilisateurRepository $repository){

        $utilisateur=$repository->OrderByNom();
        return $this->render('gestionutilisateur/Affiche.html.twig',['utilisateur'=>$utilisateur]);

    }

    /**
     * @param \App\Repository\UtilisateurRepository $repository
     * @return Response
     * @Route("/trid", name="trid")
     */
    function OrderByNom_userr(\App\Repository\UtilisateurRepository $repository){

        $utilisateur=$repository->OrderByNomm();
        return $this->render('gestionutilisateur/Affiche.html.twig',['utilisateur'=>$utilisateur]);

    }

    /**
     * @param \App\Repository\UtilisateurRepository $repository
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Response
     * @Route("/rech",name="rech")
     */



    function SearchNSC(\App\Repository\UtilisateurRepository $repository, \Symfony\Component\HttpFoundation\Request $request){
        $nomUser=$request->get('search');
        $utilisateur=$repository->SearchNSC($nomUser);
        return $this->render('gestionutilisateur/Affiche.html.twig',['utilisateur'=>$utilisateur]);

    }












}
