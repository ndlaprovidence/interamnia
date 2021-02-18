<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Stage;
use App\Form\UserType;
use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use App\Entity\RechercheEntreprise;
use App\Form\RechercheEntrepriseType;
use App\Repository\ContactRepository;
use App\Repository\EntrepriseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/entreprise")
 */
class EntrepriseController extends AbstractController
{
    /**
     * @Route("/", name="entreprise_index", methods={"GET","POST"})
     * @return Response
     */
    public function index(EntrepriseRepository $entrepriseRepository, Request $request, ContactRepository $contactRepository): Response
    {
        $user = $this->getUser();

        if (empty($user->getEmail())) {
            $form = $this->createForm(UserType::class, $user, ['email_only' => true]);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('stage_index');
            }

            return $this->render('user/set-email.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        } else {
            $search = new RechercheEntreprise();
            $form = $this->createForm(RechercheEntrepriseType::class, $search);
            $form->handleRequest($request);

            $entreprises = $entrepriseRepository->findAllVisibleQuery($search);
            $contact = $contactRepository->findOneBy(['entreprise' => $entreprises]);
            
            return $this->render('entreprise/index.html.twig', [
                'entreprises' => $entreprises,
                'contact' => $contact,
                'formSearch' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("/new", name="entreprise_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $entreprise = new Entreprise();
        
        $user = $this->getUser();
        $roles = $user->getRoles();

        if (in_array("ROLE_SUPER_ADMIN",$roles)){
            $form = $this->createForm(EntrepriseType::class, $entreprise, array('form_type' => 'prof'));            
        }
        else {
            $form = $this->createForm(EntrepriseType::class, $entreprise);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //if (user->get_roles"super_admin"alors 
                //valider=1) {
                
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entreprise);
            $entityManager->flush();

            return $this->redirectToRoute('entreprise_index');
        }

        return $this->render('entreprise/new.html.twig', [
            'entreprise' => $entreprise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/liste", name="entreprise_liste_stagiaire", methods={"GET"})
     */
    public function listeStagiaire($id): Response
    {
        $stagiaires = $this->getDoctrine()
            ->getRepository(Entreprise::class)
            ->findDataOfCompany($id);

        return $this->render('entreprise/stagiaire.html.twig', [
            'stagiaires' => $stagiaires,
        ]);
    }

    /**
     * @Route("/{id}/show", name="entreprise_show", methods={"GET"})
     */
    public function show(Entreprise $entreprise): Response
    {
        return $this->render('entreprise/show.html.twig', [
            'entreprise' => $entreprise,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="entreprise_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Entreprise $entreprise): Response
    {
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entreprise_index');
        }

        return $this->render('entreprise/edit.html.twig', [
            'entreprise' => $entreprise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="entreprise_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Entreprise $entreprise): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entreprise->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entreprise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('entreprise_index');
    }

    /**
     * @Route("/validee", name="entreprise_validee", methods={"GET","POST"})
     * 
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function validee(EntrepriseRepository $entrepriseRepository, Request $request, ContactRepository $contactRepository): Response
    {

        $user = $this->getUser();

        if (empty($user->getEmail())) {
            $form = $this->createForm(UserType::class, $user, ['email_only' => true]);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('stage_index');
            }

            return $this->render('user/set-email.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        } else {
            $search = new RechercheEntreprise();
            $form = $this->createForm(RechercheEntrepriseType::class, $search);
            $form->handleRequest($request);

            $entreprises = $entrepriseRepository->findAllVisibleQuery($search, false);
            $contact = $contactRepository->findOneBy(['entreprise' => $entreprises]);
            
            return $this->render('entreprise/validee.html.twig', [
                'entreprises' => $entreprises,
                'contact' => $contact,
                'formSearch' => $form->createView()
            ]);
        }
    }
}
