<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Airport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class AirportFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $airport = new Airport();
            $airport->setName($faker->name);
            $airport->setCity($this->getReference("city_".$i));

            $this->addReference("airport_".$i, $airport);

            $manager->persist($airport);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CityFixtures::class,
        );
    }
}
