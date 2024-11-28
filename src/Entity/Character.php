<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: '`character`')]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $imgIndex = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?CharacterClass $class = null;

    // OneToMany side for the soulTrees relationship
    #[ORM\OneToMany(mappedBy: 'character', targetEntity: SoulTree::class)]
    private Collection $soulTrees;

    public function __construct()
    {
        // Initialize the collection to prevent null errors
        $this->soulTrees = new ArrayCollection();
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

    // Getter for the soulTrees collection
    public function getSoulTrees(): Collection
    {
        return $this->soulTrees;
    }
}