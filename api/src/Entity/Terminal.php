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
 *     normalizationContext={"groups"={"terminal_read"}},
 *     denormalizationContext={"groups"={"terminal_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\TerminalRepository")
 */
class Terminal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"flight_read", "airport_read", "terminal_read", "terminal_write"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({"terminal_read", "terminal_write"})
     */
    private $code;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airport", inversedBy="terminals")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     * @Groups({"terminal_read", "terminal_write"})
     */
    private $airport;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="departureTerminal")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"terminal_read"})
     */
    private $departure;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="arrivalTerminal")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"terminal_read"})
     */
    private $arrival;

    public function __construct()
    {
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getAirport(): ?Airport
    {
        return $this->airport;
    }

    public function setAirport(?Airport $airport): self
    {
        $this->airport = $airport;

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
            $departure->setDepartureTerminal($this);
        }

        return $this;
    }

    public function removeDeparture(Flight $departure): self
    {
        if ($this->departure->contains($departure)) {
            $this->departure->removeElement($departure);
            // set the owning side to null (unless already changed)
            if ($departure->getDepartureTerminal() === $this) {
                $departure->setDepartureTerminal(null);
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
            $arrival->setArrivalTerminal($this);
        }

        return $this;
    }

    public function removeArrival(Flight $arrival): self
    {
        if ($this->arrival->contains($arrival)) {
            $this->arrival->removeElement($arrival);
            // set the owning side to null (unless already changed)
            if ($arrival->getArrivalTerminal() === $this) {
                $arrival->setArrivalTerminal(null);
            }
        }

        return $this;
    }
}
