<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\FlightsControllersRepository")
 */
class FlightsControllers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AirTraficController", inversedBy="flightsControllers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $controller;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Flight", inversedBy="flightsControllers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $flight;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getController(): ?AirTraficController
    {
        return $this->controller;
    }

    public function setController(?AirTraficController $controller): self
    {
        $this->controller = $controller;

        return $this;
    }

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): self
    {
        $this->flight = $flight;

        return $this;
    }
}
