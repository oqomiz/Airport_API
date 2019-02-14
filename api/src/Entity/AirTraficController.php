<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AirTraficControllerRepository")
 */
class AirTraficController
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthdate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FlightsControllers", mappedBy="controller")
     */
    private $flightsControllers;

    public function __construct()
    {
        $this->flightsControllers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return Collection|FlightsControllers[]
     */
    public function getFlightsControllers(): Collection
    {
        return $this->flightsControllers;
    }

    public function addFlightsController(FlightsControllers $flightsController): self
    {
        if (!$this->flightsControllers->contains($flightsController)) {
            $this->flightsControllers[] = $flightsController;
            $flightsController->setController($this);
        }

        return $this;
    }

    public function removeFlightsController(FlightsControllers $flightsController): self
    {
        if ($this->flightsControllers->contains($flightsController)) {
            $this->flightsControllers->removeElement($flightsController);
            // set the owning side to null (unless already changed)
            if ($flightsController->getController() === $this) {
                $flightsController->setController(null);
            }
        }

        return $this;
    }
}
