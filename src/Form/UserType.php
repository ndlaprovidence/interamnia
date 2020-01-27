<?php

namespace App\Form;

use App\Entity\BTS;
use App\Entity\User;
use App\Form\BTSType;
use App\Repository\BTSRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('BTS', BTSType::class, [
                'class' => BTS::class,
                'query_builder' => function (BTSRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->Select('c.nom');
                } 
            ])
            ->add('roles', ChoiceType::class, [
                'multiple' => true, // render multi-selection
                'expanded' => true, // render check-boxes
                'choices' => [
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                    'Manager' => 'ROLE_SUPER_ADMIN',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
