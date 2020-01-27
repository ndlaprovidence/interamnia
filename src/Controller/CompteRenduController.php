<?php

namespace App\Controller;

use App\Entity\RechercheStage;
use App\Entity\CompteRendu;
use App\Form\CompteRenduType;
use App\Form\RechercheStageType;
use App\Repository\CompteRenduRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/compte/rendu")
 */
class CompteRenduController extends AbstractController
{
    /**
     * @Route("/", name="compte_rendu_index", methods={"GET"})
     */
    public function index(CompteRenduRepository $compteRenduRepository, Request $request): Response
    {
        $search = new RechercheStage();
        $form = $this->createForm(RechercheStageType::class, $search);
        $form->handleRequest($request);

        $stages = $compteRenduRepository->findAllVisibleQuery($search);

        return $this->render('compte_rendu/index.html.twig', [
            'stages' => $stages,
            'formSearch' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="compte_rendu_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $compteRendu = new CompteRendu();
        $form = $this->createForm(CompteRenduType::class, $compteRendu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compteRendu);
            $entityManager->flush();

            return $this->redirectToRoute('compte_rendu_index');
        }

        return $this->render('compte_rendu/new.html.twig', [
            'compte_rendu' => $compteRendu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eleve", name="compte_rendu_eleve")
     */
    public function showEleve()
    {
        $eleve = $this->getDoctrine()
            ->getRepository(CompteRendu::class)
            ->findDataOfStudent();

        $entreprises = $eleve->getEntreprise();

        return $this->render('compte_rendu/eleve.html.twig', [
            
        ]);
    }

    /**
     * @Route("/entreprise", name="compte_rendu_entreprise")
     */
    public function showEntreprise()
    {
        $entreprise = $this->getDoctrine()
            ->getRepository(CompteRendu::class)
            ->findDataOfCompany();

        $eleves = $entreprise-getEleve();

        return $this->render('compte_rendu/entreprise.html.twig', [
            'entreprise' => $entreprise,
        ]);
    }

    /**
     * @Route("/{id}", name="compte_rendu_show", methods={"GET"})
     */
    public function show(CompteRendu $compteRendu): Response
    {
        return $this->render('compte_rendu/show.html.twig', [
            'compte_rendu' => $compteRendu,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="compte_rendu_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CompteRendu $compteRendu): Response
    {
        $form = $this->createForm(CompteRenduType::class, $compteRendu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('compte_rendu_index');
        }

        return $this->render('compte_rendu/edit.html.twig', [
            'compte_rendu' => $compteRendu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="compte_rendu_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CompteRendu $compteRendu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compteRendu->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($compteRendu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('compte_rendu_index');
    }
}