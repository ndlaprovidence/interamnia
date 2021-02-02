<?php

namespace App\Form;

use App\Entity\RechercheStage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RechercheStageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateStage', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => "Année du stage"
                ]
            ])
            ->add('eleveStage', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => "Élève ayant fait le stage"
                ]
            ])
            ->add('btsStage', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => "BTS de l'élève"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RechercheStage::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
