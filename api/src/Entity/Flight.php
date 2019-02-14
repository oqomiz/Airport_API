<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
 *     normalizationContext={"groups"={"flight_read"}},
 *     denormalizationContext={"groups"={"flight_write"}}
 * )
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
     * @Groups({"controller_read", "airport_read", "terminal_read", "track_read", "pilot_read", "plane_read", "flight_read"})
     */
    private $number;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"flight_read", "flight_write"})
     */
    private $departureDate;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"flight_read", "flight_write"})
     */
    private $arrivalDate;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"flight_read", "flight_write"})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Plane", inversedBy="flight")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     * @Groups({"flight_read", "flight_write"})
     */
    private $plane;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pilot", inversedBy="flight")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     * @Groups({"flight_read", "flight_write"})
     */
    private $pilot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Track", inversedBy="departure")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"flight_read", "flight_write"})
     */
    private $departureTrack;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Track", inversedBy="arrival")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"flight_read", "flight_write"})
     */
    private $arrivalTrack;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Terminal", inversedBy="departure")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"flight_read", "flight_write"})
     */
    private $departureTerminal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Terminal", inversedBy="arrival")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"flight_read", "flight_write"})
     */
    private $arrivalTerminal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="departure")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     * @Groups({"flight_read", "flight_write"})
     */
    private $departureAirport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="arrival")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     * @Groups({"flight_read", "flight_write"})
     */
    private $arrivalAirport;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FlightsControllers", mappedBy="flight")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"flight_read"})
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
        return $this->departureDate;
    }

    public function setDepartureDate(\DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(\DateTimeInterface $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

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
        return $this->departureTrack;
    }

    public function setDepartureTrack(?Track $departureTrack): self
    {
        $this->departureTrack = $departureTrack;

        return $this;
    }

    public function getArrivalTrack(): ?Track
    {
        return $this->arrivalTrack;
    }

    public function setArrivalTrack(?Track $arrivalTrack): self
    {
        $this->arrivalTrack = $arrivalTrack;

        return $this;
    }

    public function getDepartureTerminal(): ?Terminal
    {
        return $this->departureTerminal;
    }

    public function setDepartureTerminal(?Terminal $departureTerminal): self
    {
        $this->departureTerminal = $departureTerminal;

        return $this;
    }

    public function getArrivalTerminal(): ?Terminal
    {
        return $this->arrivalTerminal;
    }

    public function setArrivalTerminal(?Terminal $arrivalTerminal): self
    {
        $this->arrivalTerminal = $arrivalTerminal;

        return $this;
    }

    public function getDepartureAirport(): ?Airport
    {
        return $this->departureAirport;
    }

    public function setDepartureAirport(?Airport $departureAirport): self
    {
        $this->departureAirport = $departureAirport;

        return $this;
    }

    public function getArrivalAirport(): ?Airport
    {
        return $this->arrivalAirport;
    }

    public function setArrivalAirport(?Airport $arrivalAirport): self
    {
        $this->arrivalAirport = $arrivalAirport;

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
