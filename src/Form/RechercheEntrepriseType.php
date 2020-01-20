<?php

namespace App\Form;

use App\Entity\RechercheEntreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\StringType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheEntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEntreprise', StringType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => "Nom de l'entreprise"
                ]
            ])
            ->add('regionEntreprise', StringType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => "Région de l'entreprise"
                ]
            ])
            ->add('villeEntreprise', StringType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => "Ville de l'entreprise"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RechercheEntreprise::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }
}
