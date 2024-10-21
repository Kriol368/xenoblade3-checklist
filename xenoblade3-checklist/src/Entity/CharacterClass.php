<?php

namespace App\Entity;

use App\Repository\CharacterClassRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterClassRepository::class)]
class CharacterClass
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $weapon = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $role = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $offense = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $defense = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $healing = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $difficulty = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgIndex = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getWeapon(): ?string
    {
        return $this->weapon;
    }

    public function setWeapon(?string $weapon): static
    {
        $this->weapon = $weapon;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getNation(): ?string
    {
        return $this->nation;
    }

    public function setNation(?string $nation): static
    {
        $this->nation = $nation;

        return $this;
    }

    public function getOffense(): ?string
    {
        return $this->offense;
    }

    public function setOffense(?string $offense): static
    {
        $this->offense = $offense;

        return $this;
    }

    public function getDefense(): ?string
    {
        return $this->defense;
    }

    public function setDefense(?string $defense): static
    {
        $this->defense = $defense;

        return $this;
    }

    public function getHealing(): ?string
    {
        return $this->healing;
    }

    public function setHealing(?string $healing): static
    {
        $this->healing = $healing;

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

    public function getImgIndex(): ?string
    {
        return $this->imgIndex;
    }

    public function setImgIndex(?string $imgIndex): static
    {
        $this->imgIndex = $imgIndex;

        return $this;
    }
}
