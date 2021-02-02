<?php

namespace App\Controller;

use App\Entity\ActiviteEntreprise;
use App\Form\ActiviteEntrepriseType;
use App\Repository\ActiviteEntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/activite/entreprise")
 */
class ActiviteEntrepriseController extends AbstractController
{
    /**
     * @Route("/", name="activite_entreprise_index", methods={"GET"})
     */
    public function index(ActiviteEntrepriseRepository $activiteEntrepriseRepository): Response
    {
        return $this->render('activite_entreprise/index.html.twig', [
            'activite_entreprises' => $activiteEntrepriseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="activite_entreprise_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $activiteEntreprise = new ActiviteEntreprise();
        $form = $this->createForm(ActiviteEntrepriseType::class, $activiteEntreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activiteEntreprise);
            $entityManager->flush();

            return $this->redirectToRoute('activite_entreprise_index');
        }

        return $this->render('activite_entreprise/new.html.twig', [
            'activite_entreprise' => $activiteEntreprise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="activite_entreprise_show", methods={"GET"})
     */
    public function show(ActiviteEntreprise $activiteEntreprise): Response
    {
        return $this->render('activite_entreprise/show.html.twig', [
            'activite_entreprise' => $activiteEntreprise,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="activite_entreprise_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ActiviteEntreprise $activiteEntreprise): Response
    {
        $form = $this->createForm(ActiviteEntrepriseType::class, $activiteEntreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('activite_entreprise_index');
        }

        return $this->render('activite_entreprise/edit.html.twig', [
            'activite_entreprise' => $activiteEntreprise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="activite_entreprise_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ActiviteEntreprise $activiteEntreprise): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activiteEntreprise->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($activiteEntreprise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('activite_entreprise_index');
    }
}
