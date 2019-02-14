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
 *     normalizationContext={"groups"={"pilot_read"}},
 *     denormalizationContext={"groups"={"pilot_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\PilotRepository")
 */
class Pilot
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"pilot_read", "pilot_write"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"pilot_read", "pilot_write"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"pilot_read", "pilot_write"})
     */
    private $birthdate;

    /**
     * @ORM\OneToMany(targetEntity="Flight", mappedBy="pilot")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"pilot_read"})
     */
    private $flight;

    public function __construct()
    {
        $this->flight = new ArrayCollection();
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
     * @return Collection|Flight[]
     */
    public function getflight(): Collection
    {
        return $this->flight;
    }

    public function addFlight(Flight $flight): self
    {
        if (!$this->flight->contains($flight)) {
            $this->flight[] = $flight;
            $flight->setPilot($this);
        }

        return $this;
    }

    public function removeFlight(Flight $flight): self
    {
        if ($this->flight->contains($flight)) {
            $this->flight->removeElement($flight);
            // set the owning side to null (unless already changed)
            if ($flight->getPilot() === $this) {
                $flight->setPilot(null);
            }
        }

        return $this;
    }
}
