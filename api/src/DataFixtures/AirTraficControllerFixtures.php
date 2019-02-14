<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\AirTraficController;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AirTraficControllerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $controller = new AirTraficController();
            $controller->setFirstname($faker->firstName);
            $controller->setLastname($faker->lastName);
            $controller->setBirthdate($faker->dateTime($max = "-18 years"));

            $this->addReference("controller_".$i, $controller);

            $manager->persist($controller);
        }

        $manager->flush();
    }
}
