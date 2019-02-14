<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Track;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class TrackFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $track = new Track();
            $track->setName($faker->word);
            $track->setCode($faker->swiftBicNumber);
            $track->setAirport($this->getReference("airport_".$i));

            $this->addReference("track_".$i, $track);

            $manager->persist($track);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AirportFixtures::class,
        );
    }
}
