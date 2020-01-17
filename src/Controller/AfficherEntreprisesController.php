<?php

namespace App\Controller;

use App\Form\EntrepriseType;
use App\Entity\Entreprise;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AfficherEntreprisesController extends AbstractController
{
    /**
     * @Route("/stage", name="afficher_entreprises")
     */
    public function showEntreprises()
    {
        $repository = $this->getDoctrine()
                           ->getManager()
                           ->getRepository(Entreprise::class);
        $listeEntreprises = $repository->findAll();


        return $this->render(
            'afficher_entreprises/index.html.twig',
            array('listeEntreprises' => $listeEntreprises)
        );
    }

    /**
     * @Route("/stage", name="recherche_approfondie")
     */
    public function rechercheApprofondie(Request $request)
    {
        $article = new Article();

        $form = $this->createFormBuilder($article)
                     ->add('Nom')
                     ->add('Région')
                     ->add('Ville')
                     ->getForm();
        return $this->render('afficher_entreprise/index.html.twig', [
            'formArticle' => $form->createView()
        ]);

    }
}
