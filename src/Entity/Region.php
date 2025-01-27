<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Area::class, mappedBy: 'region')]
    private Collection $areas;

    #[ORM\OneToMany(targetEntity: Quest::class, mappedBy: 'region')]
    private Collection $quests;

    #[ORM\OneToMany(targetEntity: LandmarkLocation::class, mappedBy: 'region')]
    private Collection $landmarkLocations;

    public function __construct()
    {
        $this->areas = new ArrayCollection();
        $this->quests = new ArrayCollection();
        $this->landmarkLocations = new ArrayCollection();
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

    /**
     * @return Collection<int, Area>
     */
    public function getAreas(): Collection
    {
        return $this->areas;
    }

    public function addArea(Area $area): static
    {
        if (!$this->areas->contains($area)) {
            $this->areas->add($area);
            $area->setRegion($this);
        }

        return $this;
    }

    public function removeArea(Area $area): static
    {
        if ($this->areas->removeElement($area)) {
            // set the owning side to null (unless already changed)
            if ($area->getRegion() === $this) {
                $area->setRegion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Quest>
     */
    public function getQuests(): Collection
    {
        return $this->quests;
    }

    public function addQuest(Quest $quest): static
    {
        if (!$this->quests->contains($quest)) {
            $this->quests->add($quest);
            $quest->setRegion($this);
        }

        return $this;
    }

    public function removeQuest(Quest $quest): static
    {
        if ($this->quests->removeElement($quest)) {
            // set the owning side to null (unless already changed)
            if ($quest->getRegion() === $this) {
                $quest->setRegion(null);
            }
        }

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
            $landmarkLocation->setRegion($this);
        }

        return $this;
    }

    public function removeLandmarkLocation(LandmarkLocation $landmarkLocation): static
    {
        if ($this->landmarkLocations->removeElement($landmarkLocation)) {
            // set the owning side to null (unless already changed)
            if ($landmarkLocation->getRegion() === $this) {
                $landmarkLocation->setRegion(null);
            }
        }

        return $this;
    }
}
