<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class CityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $city = new City();
            $city->setName($faker->city);
            $city->setCountry($this->getReference("country_".$i));

            $this->addReference("city_".$i, $city);

            $manager->persist($city);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CountryFixtures::class,
        );
    }
}
