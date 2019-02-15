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
 *     normalizationContext={"groups"={"city_read"}},
 *     denormalizationContext={"groups"={"city_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 */
class City
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"country_read", "airport_read", "city_read", "city_write"})
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="cities")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource(maxDepth=1)
     * @Groups({"city_read", "city_write"})
     * @Assert\NotNull()
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Airport", mappedBy="city")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"city_read"})
     */
    private $airports;

    public function __construct()
    {
        $this->airports = new ArrayCollection();
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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Airport[]
     */
    public function getAirports(): Collection
    {
        return $this->airports;
    }

    public function addAirport(Airport $airport): self
    {
        if (!$this->airports->contains($airport)) {
            $this->airports[] = $airport;
            $airport->setCity($this);
        }

        return $this;
    }

    public function removeAirport(Airport $airport): self
    {
        if ($this->airports->contains($airport)) {
            $this->airports->removeElement($airport);
            // set the owning side to null (unless already changed)
            if ($airport->getCity() === $this) {
                $airport->setCity(null);
            }
        }

        return $this;
    }
}
