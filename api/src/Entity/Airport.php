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
 *     normalizationContext={"groups"={"airport_read"}},
 *     denormalizationContext={"groups"={"airport_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AirportRepository")
 */
class Airport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"flight_read", "terminal_read", "track_read", "city_read", "airport_read", "airport_write"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="1",
     *     max="255",
     *     minMessage="Le nom doit être de 1 lettre minimum",
     *     maxMessage="Le nom doit être de 255 Lettres maximum",
     *     groups={"postValidation", "putValidation"}
     * )
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="airports")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     * @Groups({"airport_read", "airport_write"})
     * @Assert\NotNull()
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Track", mappedBy="airport")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"airport_read"})
     */
    private $tracks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Terminal", mappedBy="airport")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"airport_read"})
     */
    private $terminals;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="departureAirport")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"airport_read"})
     */
    private $departure;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="arrivalAirport")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"airport_read"})
     */
    private $arrival;

    public function __construct()
    {
        $this->tracks = new ArrayCollection();
        $this->terminals = new ArrayCollection();
        $this->departure = new ArrayCollection();
        $this->arrival = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection|Track[]
     */
    public function getTracks(): Collection
    {
        return $this->tracks;
    }

    public function addTrack(Track $track): self
    {
        if (!$this->tracks->contains($track)) {
            $this->tracks[] = $track;
            $track->setAirport($this);
        }

        return $this;
    }

    public function removeTrack(Track $track): self
    {
        if ($this->tracks->contains($track)) {
            $this->tracks->removeElement($track);
            // set the owning side to null (unless already changed)
            if ($track->getAirport() === $this) {
                $track->setAirport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Terminal[]
     */
    public function getTerminals(): Collection
    {
        return $this->terminals;
    }

    public function addTerminal(Terminal $terminal): self
    {
        if (!$this->terminals->contains($terminal)) {
            $this->terminals[] = $terminal;
            $terminal->setAirport($this);
        }

        return $this;
    }

    public function removeTerminal(Terminal $terminal): self
    {
        if ($this->terminals->contains($terminal)) {
            $this->terminals->removeElement($terminal);
            // set the owning side to null (unless already changed)
            if ($terminal->getAirport() === $this) {
                $terminal->setAirport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getDeparture(): Collection
    {
        return $this->departure;
    }

    public function addDeparture(Flight $departure): self
    {
        if (!$this->departure->contains($departure)) {
            $this->departure[] = $departure;
            $departure->setDepartureAirport($this);
        }

        return $this;
    }

    public function removeDeparture(Flight $departure): self
    {
        if ($this->departure->contains($departure)) {
            $this->departure->removeElement($departure);
            // set the owning side to null (unless already changed)
            if ($departure->getDepartureAirport() === $this) {
                $departure->setDepartureAirport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getArrival(): Collection
    {
        return $this->arrival;
    }

    public function addArrival(Flight $arrival): self
    {
        if (!$this->arrival->contains($arrival)) {
            $this->arrival[] = $arrival;
            $arrival->setArrivalAirport($this);
        }

        return $this;
    }

    public function removeArrival(Flight $arrival): self
    {
        if ($this->arrival->contains($arrival)) {
            $this->arrival->removeElement($arrival);
            // set the owning side to null (unless already changed)
            if ($arrival->getArrivalAirport() === $this) {
                $arrival->setArrivalAirport(null);
            }
        }

        return $this;
    }
}
