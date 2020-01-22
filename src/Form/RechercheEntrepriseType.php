<?php

namespace App\Form;

use App\Entity\RechercheEntreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RechercheEntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEntreprise', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => "Nom de l'entreprise"
                ]
            ])
            ->add('regionEntreprise', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => "Région de l'entreprise"
                ]
            ])
            ->add('villeEntreprise', TextType::class, [
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

    public function getBlockPrefix()
    {
        return '';
    }
}
