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
 *     normalizationContext={"groups"={"country_read"}},
 *     denormalizationContext={"groups"={"country_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"city_read", "country_read", "country_write"})
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
     * @ORM\Column(type="string", length=5)
     * @Groups({"country_read", "country_write"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="2",
     *     max="2",
     *     exactMessage="Le code doit être composé de 2 Lettres",
     *     groups={"postValidation", "putValidation"}
     * )
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({"country_read", "country_write"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="2",
     *     max="45",
     *     minMessage="La langue doit être de 1 lettre minimum",
     *     maxMessage="La langue doit être de 45 Lettres maximum",
     *     groups={"postValidation", "putValidation"}
     * )
     */
    private $lang;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\City", mappedBy="country")
     * @ApiSubresource(maxDepth=1)
     * @Groups({"country_read"})
     */
    private $cities;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
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

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * @return Collection|City[]
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): self
    {
        if (!$this->cities->contains($city)) {
            $this->cities[] = $city;
            $city->setCountry($this);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        if ($this->cities->contains($city)) {
            $this->cities->removeElement($city);
            // set the owning side to null (unless already changed)
            if ($city->getCountry() === $this) {
                $city->setCountry(null);
            }
        }

        return $this;
    }
}
