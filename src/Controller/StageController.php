<?php

// Ajouter le BTS, l'option et l'année dans la création du compte-rendu

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\User;
use App\Entity\Stage;
use App\Form\UserType;
use App\Form\StageType;
use App\Entity\RechercheStage;
use App\Form\RechercheStageType;
use App\Repository\StageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/stage")
 */
class StageController extends AbstractController
{
    /**
     * @Route("/", name="stage_index", methods={"GET","POST"})
     */
    public function index(StageRepository $stageRepository, Request $request): Response
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
            $search = new RechercheStage();
            $form = $this->createForm(RechercheStageType::class, $search);
            $form->handleRequest($request);

            $stages = $stageRepository->findAllVisibleQuery($search);

            return $this->render('stage/index.html.twig', [
                'stages' => $stages,
                'formSearch' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/new", name="stage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $stage = new Stage();
        $form = $this->createForm(StageType::class, $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stage);
            $entityManager->flush();

            return $this->redirectToRoute('stage_index');
        }

        return $this->render('stage/new.html.twig', [
            'stage' => $stage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/pdf", name="stage_pdf", methods={"GET"})
     */
    public function pdf(StageRepository $stageRepository)
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);
        $stages = $stageRepository->findAll();
        $html = $this->renderView('stage/pdf.html.twig', [
            'stages' => $stages,
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }

    /**
     * @Route("/{id}", name="stage_show", methods={"GET"})
     */
    public function show(Stage $stage): Response
    {
        return $this->render('stage/show.html.twig', [
            'stage' => $stage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="stage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Stage $stage): Response
    {
        $form = $this->createForm(StageType::class, $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stage_index');
        }

        return $this->render('stage/edit.html.twig', [
            'stage' => $stage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Stage $stage): Response
    {
        if ($this->isCsrfTokenValid('delete' . $stage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('stage_index');
    }
}
