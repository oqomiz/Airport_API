<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Plane;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class PlaneFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $plane = new Plane();
            $plane->setSerialNumber($faker->swiftBicNumber);
            $plane->setCompany($this->getReference("company_".$i));

            $this->addReference("plane_".$i, $plane);

            $manager->persist($plane);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CompanyFixtures::class,
        );
    }
}
