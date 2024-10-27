<?php

namespace App\Entity;

use App\Repository\SoulTreeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SoulTreeRepository::class)]
class SoulTree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $effect = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Character $related_character = null;

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

    public function getRelatedCharacter(): ?Character
    {
        return $this->related_character;
    }

    public function setRelatedCharacter(?Character $related_character): static
    {
        $this->related_character = $related_character;

        return $this;
    }
}
