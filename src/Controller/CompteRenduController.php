<?php

namespace App\Controller;

use App\Form\ComtpeRenduType;
use App\Entity\Stage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CompteRenduController extends Controller
{
    /**
     * @Route("/compte-rendu", name="compte_rendu")
     */
    public function addReport(Request $request)
    {
        $compteRendu = new Stage();
        $form = $this->createForm(CompteRenduType::class, $compteRendu);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compteRendu);
            $entityManager->flush();

            return $this->redirectToRoute('default');
        }

        return $this->render(
            'compte_rendu/index.html.twig',
            array('form' => $form->createView()),
        );
    }
}
