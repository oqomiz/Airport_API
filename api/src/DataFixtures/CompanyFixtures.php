<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $company = new Company();
            $company->setName($faker->company);

            $this->addReference("company_".$i, $company);

            $manager->persist($company);
        }

        $manager->flush();
    }
}
