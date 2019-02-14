<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\FlightsControllers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class FlightsControllersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $flightcontroller = new FlightsControllers();
            $flightcontroller->setFlight($this->getReference("flight_".$i));
            $flightcontroller->setController($this->getReference("controller_".$i));

            $manager->persist($flightcontroller);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            FlightFixtures::class,
        );
    }
}
