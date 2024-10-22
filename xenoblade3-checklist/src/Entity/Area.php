<?php

namespace App\Entity;

use App\Repository\AreaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AreaRepository::class)]
class Area
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'areas')]
    private ?Region $region = null;

    #[ORM\OneToMany(targetEntity: LandmarkLocation::class, mappedBy: 'area')]
    private Collection $landmarkLocations;

    #[ORM\OneToMany(targetEntity: UniqueMonster::class, mappedBy: 'area')]
    private Collection $uniqueMonsters;

    public function __construct()
    {
        $this->landmarkLocations = new ArrayCollection();
        $this->uniqueMonsters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): static
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection<int, LandmarkLocation>
     */
    public function getLandmarkLocations(): Collection
    {
        return $this->landmarkLocations;
    }

    public function addLandmarkLocation(LandmarkLocation $landmarkLocation): static
    {
        if (!$this->landmarkLocations->contains($landmarkLocation)) {
            $this->landmarkLocations->add($landmarkLocation);
            $landmarkLocation->setArea($this);
        }

        return $this;
    }

    public function removeLandmarkLocation(LandmarkLocation $landmarkLocation): static
    {
        if ($this->landmarkLocations->removeElement($landmarkLocation)) {
            // set the owning side to null (unless already changed)
            if ($landmarkLocation->getArea() === $this) {
                $landmarkLocation->setArea(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UniqueMonster>
     */
    public function getUniqueMonsters(): Collection
    {
        return $this->uniqueMonsters;
    }

    public function addUniqueMonster(UniqueMonster $uniqueMonster): static
    {
        if (!$this->uniqueMonsters->contains($uniqueMonster)) {
            $this->uniqueMonsters->add($uniqueMonster);
            $uniqueMonster->setArea($this);
        }

        return $this;
    }

    public function removeUniqueMonster(UniqueMonster $uniqueMonster): static
    {
        if ($this->uniqueMonsters->removeElement($uniqueMonster)) {
            // set the owning side to null (unless already changed)
            if ($uniqueMonster->getArea() === $this) {
                $uniqueMonster->setArea(null);
            }
        }

        return $this;
    }
}
