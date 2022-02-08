<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
        
    }
    public function load(ObjectManager $manager, ): void
    {
        for ($i=0; $i < 10 ; $i++) { 
            $user = new User();
            $user->setEmail('user'.$i.'@gmail.com');
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setUpdatedAt(new \DateTimeImmutable());
            $user->setPassword($this->userPasswordHasher->hashPassword(
                $user,
                '123456'
            ));
            $manager->persist($user);
        }

        $user = new User();
        $user->setEmail('hamza.karfa@gmail.com');
        $user->setPassword($this->userPasswordHasher->hashPassword(
            $user,
            '123456'
        ));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTimeImmutable());

        $manager->persist($user);
        $manager->flush();
    }
}
