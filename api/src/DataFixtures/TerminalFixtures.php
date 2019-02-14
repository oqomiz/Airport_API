<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Terminal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class TerminalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $terminal = new Terminal();
            $terminal->setName($faker->word);
            $terminal->setCode($faker->swiftBicNumber);
            $terminal->setAirport($this->getReference("airport_".$i));

            $this->addReference("terminal_".$i, $terminal);

            $manager->persist($terminal);
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
