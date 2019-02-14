<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Flight;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class FlightFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $flight = new Flight();
            $flight->setNumber($faker->swiftBicNumber);
            $flight->setDepartureDate($faker->dateTimeInInterval($startDate = 'now', $interval = '+ 5 days'));
            $flight->setArrivalDate($faker->dateTimeInInterval($startDate = '+ 6 days', $interval = '+ 10 days'));
            $flight->setStatus("0");
            $flight->setPlane($this->getReference("plane_".$i));
            $flight->setPilot($this->getReference("pilot_".$i));
            $flight->setDepartureTrack($this->getReference("track_".$i));
            $flight->setDepartureTerminal($this->getReference("terminal_".$i));
            $flight->setDepartureAirport($this->getReference("airport_".$i));
            $j = ($i+5)%10;
            $flight->setArrivalTrack($this->getReference("track_".$j));
            $flight->setArrivalTerminal($this->getReference("terminal_".$j));
            $flight->setArrivalAirport($this->getReference("airport_".$j));

            $this->addReference("flight_".$i, $flight);

            $manager->persist($flight);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            PlaneFixtures::class,
            PilotFixtures::class,
            TrackFixtures::class,
            TerminalFixtures::class,
        );
    }
}
