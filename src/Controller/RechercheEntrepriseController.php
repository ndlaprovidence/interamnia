<?php

namespace App\Controller;

use App\Entity\RechercheEntreprise;
use App\Form\RechercheEntrepriseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheEntrepriseController extends AbstractController
{
    /**
     * @Route("/recherche/entreprise", name="recherche_entreprise")
     */
    public function search(Request $request): Response
    {
        $search = new RechercheEntreprise();
        $form = $this->createForm(RechercheEntreprise::class, $search);
        $form->handleRequest($request);

        return $this->render('recherche_entreprise/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
