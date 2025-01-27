<?php

namespace App\Entity;

use App\Repository\ArtRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtRepository::class)]
class Art
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rechargeType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $effect = null;

    #[ORM\Column(nullable: true)]
    private ?int $powerMultiplier = null;

    #[ORM\Column(nullable: true)]
    private ?float $recharge = null;

    #[ORM\Column(nullable: true)]
    private ?int $masterLevel = null;

    #[ORM\Column(nullable: true)]
    private ?int $imgIndex = null;

    #[ORM\ManyToOne(inversedBy: 'art')]
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getRechargeType(): ?string
    {
        return $this->rechargeType;
    }

    public function setRechargeType(?string $rechargeType): static
    {
        $this->rechargeType = $rechargeType;

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

    public function getPowerMultiplier(): ?int
    {
        return $this->powerMultiplier;
    }

    public function setPowerMultiplier(?int $powerMultiplier): static
    {
        $this->powerMultiplier = $powerMultiplier;

        return $this;
    }

    public function getRecharge(): ?float
    {
        return $this->recharge;
    }

    public function setRecharge(?float $recharge): static
    {
        $this->recharge = $recharge;

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
