<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $country = new Country();
            $country->setName($faker->country);
            $country->setCode($faker->countryCode);
            $country->setLang($faker->languageCode);

            $this->addReference("country_".$i, $country);

            $manager->persist($country);
        }

        $manager->flush();
    }
}
