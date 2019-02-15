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
 *     normalizationContext={"groups"={"airController_read"}},
 *     denormalizationContext={"groups"={"airController_write"}}
 * )
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
     * @Groups({"controller_read", "airController_read", "airController_write"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="1",
     *     max="255",
     *     minMessage="Le prénom doit être de 1 lettre minimum",
     *     maxMessage="Le prénom doit être de 255 Lettres maximum",
     *     groups={"postValidation", "putValidation"}
     * )
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"controller_read", "airController_read", "airController_write"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="1",
     *     max="255",
     *     minMessage="Le nom doit être de 1 lettre minimum",
     *     maxMessage="Le nom doit être de 255 Lettres maximum",
     *     groups={"postValidation", "putValidation"}
     * )
     */
    private $lastname;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"airController_read", "airController_write"})
     * @Assert\NotBlank()
     * @Assert\LessThanOrEqual("-18 years")
     * @Assert\GreaterThanOrEqual("-70 years")
     */
    private $birthdate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FlightsControllers", mappedBy="controller")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"airController_read"})
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
