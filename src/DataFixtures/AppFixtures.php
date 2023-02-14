<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Micropost;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture 
{
    
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

        $manager->flush();
    }
}
