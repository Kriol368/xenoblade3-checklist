<?php

namespace App\Entity;

use App\Repository\ChallengeModeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChallengeModeRepository::class)]
class ChallengeMode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $difficulty = null;

    #[ORM\Column(nullable: true)]
    private ?int $waves = null;

    #[ORM\Column(nullable: true)]
    private ?int $levelRestriction = null;

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

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(?string $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getWaves(): ?int
    {
        return $this->waves;
    }

    public function setWaves(?int $waves): static
    {
        $this->waves = $waves;

        return $this;
    }

    public function getLevelRestriction(): ?int
    {
        return $this->levelRestriction;
    }

    public function setLevelRestriction(?int $levelRestriction): static
    {
        $this->levelRestriction = $levelRestriction;

        return $this;
    }
}
