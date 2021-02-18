<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class StageType extends AbstractType
 {
    public function buildForm( FormBuilderInterface $builder, array $options )
 {
        $builder

        ->add( 'theme' )
        ->add( 'periode' )
        // ->add( 'commentaire' )
        ->add( 'user' ) // Choisir uniquement les élèves parmis les utilisateurs
        // ->add( 'user' ) // Choisir uniquement les profs parmis les utilisateurs ( EntityType -> Where RoleP = Admin )
        ->add( 'bts' )
        ->add( 'entreprise' )
        ->add( 'contact' )
        ->add( 'prof' )
        ->add( 'date_debut', DateType::class, [
            'widget' => 'single_text',
        ] )
        ->add( 'date_fin', DateType::class, [
            'widget' => 'single_text',
        ] );
        if ( $options['form_type'] == 'prof' ) {
            $builder->add( 'validee' );
        }

        ;
    }

    public function configureOptions( OptionsResolver $resolver )
 {
        $resolver->setDefaults( [
            'data_class' => Stage::class,
            'form_type' => 'eleve',
        ] );
    }
}
