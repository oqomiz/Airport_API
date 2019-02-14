<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Pilot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PilotFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $pilot = new Pilot();
            $pilot->setFirstname($faker->firstName);
            $pilot->setLastname($faker->lastName);
            $pilot->setBirthdate($faker->dateTime($max = "-18 years"));

            $this->addReference("pilot_".$i, $pilot);

            $manager->persist($pilot);
        }

        $manager->flush();
    }
}
