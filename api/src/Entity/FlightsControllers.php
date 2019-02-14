<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *@ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"={"validation_groups"={"Default", "postValidation"}}
 *     },
 *     itemOperations={
 *         "delete",
 *         "get",
 *         "put"={"validation_groups"={"Default", "putValidation"}}
 *     },
 *     normalizationContext={"groups"={"controller_read"}},
 *     denormalizationContext={"groups"={"controller_write"}}
 * )
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
     * @Groups({"controller_read", "controller_write"})
     */
    private $controller;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Flight", inversedBy="flightsControllers")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"controller_read", "controller_write"})
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
