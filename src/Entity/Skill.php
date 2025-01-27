<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkillRepository::class)]
class Skill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $effect = null;

    #[ORM\Column(nullable: true)]
    private ?int $masterLevel = null;

    #[ORM\Column(nullable: true)]
    private ?int $imgIndex = null;

    #[ORM\ManyToOne(inversedBy: 'skills')]
    private ?CharacterClass $class = null;

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

    public function getEffect(): ?string
    {
        return $this->effect;
    }

    public function setEffect(?string $effect): static
    {
        $this->effect = $effect;

        return $this;
    }

    public function getMasterLevel(): ?int
    {
        return $this->masterLevel;
    }

    public function setMasterLevel(?int $masterLevel): static
    {
        $this->masterLevel = $masterLevel;

        return $this;
    }

    public function getImgIndex(): ?int
    {
        return $this->imgIndex;
    }

    public function setImgIndex(?int $imgIndex): static
    {
        $this->imgIndex = $imgIndex;

        return $this;
    }

    public function getClass(): ?CharacterClass
    {
        return $this->class;
    }

    public function setClass(?CharacterClass $class): static
    {
        $this->class = $class;

        return $this;
    }
}
