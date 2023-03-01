<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Micropost;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture 
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
        ){    
        }
    
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $micropost = Array();

        for($i=0; $i < 20; $i++){
            $micropost[$i] = new Micropost();
            $micropost[$i]->setTitle($faker->sentence());
            $micropost[$i]->setText($faker->text());
            $micropost[$i]->setDatetime($faker->dateTime());

            $manager->persist($micropost[$i]);
        }

        for($i=0; $i < 10; $i++){
            $user[$i] = new User();
            $user[$i]->setEmail($faker->email());
            $user[$i]->setPassword($this->userPasswordHasher->hashPassword(
                $user[$i],
                '123456789'));

            $manager->persist($user[$i]);
        }

        $manager->flush();
    }
}
