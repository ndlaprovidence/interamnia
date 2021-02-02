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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // dump($options['email_only']); exit;
        if ($options['email_only']) {
            $builder
                ->add('email', RepeatedType::class, array(
                    'type' => EmailType::class,
                    'first_options' => array('label' => 'Email'),
                    'second_options' => array('label' => 'Répéter votre email')
                ));
        } else {
            $builder
                ->add('nom')
                ->add('prenom')
                ->add('email', RepeatedType::class, array(
                    'type' => EmailType::class,
                    'first_options' => array('label' => 'Email'),
                    'second_options' => array('label' => 'Répéter votre email')
                ))
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
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'email_only' => false,
        ]);
    }
}
