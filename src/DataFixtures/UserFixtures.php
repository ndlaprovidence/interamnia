<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setNom('superadmin');
        $user->setPrenom('superadmin');
        $user->setEmail('superadmin@domain.tld'); 
        $user->setLogin('superadmin'); 
        $user->setRoles(['ROLE_SUPER_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'superadmin'
        ));
        $manager->persist($user);

        $user = new User();
        $user->setNom('admin');
        $user->setPrenom('admin');
        $user->setEmail('admin@domain.tld'); 
        $user->setLogin('admin'); 
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));
        $manager->persist($user);

        $user = new User();
        $user->setNom('user');
        $user->setPrenom('user');
        $user->setEmail('user@domain.tld'); 
        $user->setLogin('user'); 
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'user'
        ));
        $manager->persist($user);

        $manager->flush();
    }
}
