<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\FlightRepository")
 */
class Flight
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
    private $number;

    /**
     * @ORM\Column(type="datetime")
     */
    private $departure_Date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $arrival_Date;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Plane", inversedBy="flight")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plane;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pilot", inversedBy="flight")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pilot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Track", inversedBy="departure")
     */
    private $departure_Track;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Track", inversedBy="arrival")
     */
    private $arrival_Track;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Terminal", inversedBy="departure")
     */
    private $departure_Terminal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Terminal", inversedBy="arrival")
     */
    private $arrival_Terminal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="departure")
     * @ORM\JoinColumn(nullable=false)
     */
    private $departure_Airport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="arrival")
     * @ORM\JoinColumn(nullable=false)
     */
    private $arrival_Airport;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FlightsControllers", mappedBy="flight")
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

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departure_Date;
    }

    public function setDepartureDate(\DateTimeInterface $departure_Date): self
    {
        $this->departure_Date = $departure_Date;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrival_Date;
    }

    public function setArrivalDate(\DateTimeInterface $arrival_Date): self
    {
        $this->arrival_Date = $arrival_Date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPlane(): ?Plane
    {
        return $this->plane;
    }

    public function setPlane(?Plane $plane): self
    {
        $this->plane = $plane;

        return $this;
    }

    public function getPilot(): ?Pilot
    {
        return $this->pilot;
    }

    public function setPilot(?Pilot $pilot): self
    {
        $this->pilot = $pilot;

        return $this;
    }

    public function getDepartureTrack(): ?Track
    {
        return $this->departure_Track;
    }

    public function setDepartureTrack(?Track $departure_Track): self
    {
        $this->departure_Track = $departure_Track;

        return $this;
    }

    public function getArrivalTrack(): ?Track
    {
        return $this->arrival_Track;
    }

    public function setArrivalTrack(?Track $arrival_Track): self
    {
        $this->arrival_Track = $arrival_Track;

        return $this;
    }

    public function getDepartureTerminal(): ?Terminal
    {
        return $this->departure_Terminal;
    }

    public function setDepartureTerminal(?Terminal $departure_Terminal): self
    {
        $this->departure_Terminal = $departure_Terminal;

        return $this;
    }

    public function getArrivalTerminal(): ?Terminal
    {
        return $this->arrival_Terminal;
    }

    public function setArrivalTerminal(?Terminal $arrival_Terminal): self
    {
        $this->arrival_Terminal = $arrival_Terminal;

        return $this;
    }

    public function getDepartureAirport(): ?Airport
    {
        return $this->departure_Airport;
    }

    public function setDepartureAirport(?Airport $departure_Airport): self
    {
        $this->departure_Airport = $departure_Airport;

        return $this;
    }

    public function getArrivalAirport(): ?Airport
    {
        return $this->arrival_Airport;
    }

    public function setArrivalAirport(?Airport $arrival_Airport): self
    {
        $this->arrival_Airport = $arrival_Airport;

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
            $flightsController->setFlight($this);
        }

        return $this;
    }

    public function removeFlightsController(FlightsControllers $flightsController): self
    {
        if ($this->flightsControllers->contains($flightsController)) {
            $this->flightsControllers->removeElement($flightsController);
            // set the owning side to null (unless already changed)
            if ($flightsController->getFlight() === $this) {
                $flightsController->setFlight(null);
            }
        }

        return $this;
    }
}
