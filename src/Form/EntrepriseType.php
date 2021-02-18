<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
 {
    public function buildForm( FormBuilderInterface $builder, array $options )
 {
        $builder
        ->add( 'nom' )
        ->add( 'region' )
        ->add( 'departement' )
        ->add( 'ville' )
        ->add( 'code_postal' )
        ->add( 'rue' )
        ->add( 'telephone' )
        ->add( 'email' )
        ->add( 'activite' );
        if ( $options['form_type'] == 'prof' ) {
            $builder->add( 'validee' );
        }

    }

    public function configureOptions( OptionsResolver $resolver )
 {
        $resolver->setDefaults( [
            'data_class' => Entreprise::class,
            'form_type' => 'eleve',
        ] );
    }

}
