<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_debut', DateType::class, [
                'widget' => 'choice',
            ])
            ->add('date_fin', DateType::class, [
                'widget' => 'choice',
            ])
            ->add('theme')
            // ->add('commentaire')
            ->add('user') // Choisir uniquement les élèves parmis les utilisateurs
            // ->add('user') // Choisir uniquement les profs parmis les utilisateurs (EntityType -> Where RoleP = Admin)
            ->add('bts')
            ->add('entreprise')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
