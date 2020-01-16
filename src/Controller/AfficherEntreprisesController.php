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

    public function RechercheApprofondie(Request $request)
    {
        $defaultData = ['message' => 'Type your message here'];
        $form = $this->createFormBuilder($defaultData)
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class)
            ->getForm();
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
        }

        return $this->render(
            'afficher_entreprises/index.html.twig',
            array('data' => $data)
        );
    }
}
