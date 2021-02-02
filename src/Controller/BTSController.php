<?php

namespace App\Controller;

use App\Entity\BTS;
use App\Form\BTSType;
use App\Repository\BTSRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/b/t/s")
 */
class BTSController extends AbstractController
{
    /**
     * @Route("/", name="b_t_s_index", methods={"GET"})
     */
    public function index(BTSRepository $bTSRepository): Response
    {
        return $this->render('bts/index.html.twig', [
            'b_t_ss' => $bTSRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="b_t_s_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bT = new BTS();
        $form = $this->createForm(BTSType::class, $bT);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bT);
            $entityManager->flush();

            return $this->redirectToRoute('b_t_s_index');
        }

        return $this->render('bts/new.html.twig', [
            'b_t' => $bT,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="b_t_s_show", methods={"GET"})
     */
    public function show(BTS $bT): Response
    {
        return $this->render('bts/show.html.twig', [
            'b_t' => $bT,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="b_t_s_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BTS $bT): Response
    {
        $form = $this->createForm(BTSType::class, $bT);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('b_t_s_index');
        }

        return $this->render('bts/edit.html.twig', [
            'b_t' => $bT,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="b_t_s_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BTS $bT): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bT->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bT);
            $entityManager->flush();
        }

        return $this->redirectToRoute('b_t_s_index');
    }
}
