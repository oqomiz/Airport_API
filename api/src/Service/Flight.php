<?php

declare(strict_types=1);

namespace App\Service;

use Faker;

/**
 * Service for Json actions
 * @package App\Service\Flight
 */
class Flight
{
    /**
     * Generate a random flight number
     * @return string
     */
    public function generateFlightNumber(): string
    {
        $faker = Faker\Factory::create('fr_FR');
        $number = $faker->swiftBicNumber;
        $number = substr($number, 0, 5);
        $number .= rand(0, 9) . rand(0, 9);

        return $number;
    }
}
