<?php

namespace App\Entity;

use App\Repository\UserCharacterClassRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserCharacterClassRepository::class)]
#[ORM\Table(name: "user_character_class")] // Optional: specify the table name
class UserCharacterClass
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private User $user;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: CharacterClass::class)]
    #[ORM\JoinColumn(name: "character_class_id", referencedColumnName: "id", nullable: false)]
    private CharacterClass $characterClass;

    #[ORM\Column(type: 'boolean')]
    private bool $unlocked;

    #[ORM\Column(type: 'boolean')]
    private bool $ascended;

    #[ORM\Column(type: 'boolean')]
    private bool $noah;

    #[ORM\Column(type: 'boolean')]
    private bool $mio;

    #[ORM\Column(type: 'boolean')]
    private bool $eunie;

    #[ORM\Column(type: 'boolean')]
    private bool $taion;

    #[ORM\Column(type: 'boolean')]
    private bool $lanz;

    #[ORM\Column(type: 'boolean')]
    private bool $sena;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getCharacterClass(): CharacterClass
    {
        return $this->characterClass;
    }

    public function setCharacterClass(CharacterClass $characterClass): self
    {
        $this->characterClass = $characterClass;
        return $this;
    }

    public function isUnlocked(): bool
    {
        return $this->unlocked;
    }

    public function setUnlocked(bool $unlocked): self
    {
        $this->unlocked = $unlocked;
        return $this;
    }

    public function isAscended(): bool
    {
        return $this->ascended;
    }

    public function setAscended(bool $ascended): self
    {
        $this->ascended = $ascended;
        return $this;
    }

    public function isNoah(): bool
    {
        return $this->noah;
    }

    public function setNoah(bool $noah): self
    {
        $this->noah = $noah;
        return $this;
    }

    public function isMio(): bool
    {
        return $this->mio;
    }

    public function setMio(bool $mio): self
    {
        $this->mio = $mio;
        return $this;
    }

    public function isEunie(): bool
    {
        return $this->eunie;
    }

    public function setEunie(bool $eunie): self
    {
        $this->eunie = $eunie;
        return $this;
    }

    public function isTaion(): bool
    {
        return $this->taion;
    }

    public function setTaion(bool $taion): self
    {
        $this->taion = $taion;
        return $this;
    }

    public function isLanz(): bool
    {
        return $this->lanz;
    }

    public function setLanz(bool $lanz): self
    {
        $this->lanz = $lanz;
        return $this;
    }

    public function isSena(): bool
    {
        return $this->sena;
    }

    public function setSena(bool $sena): self
    {
        $this->sena = $sena;
        return $this;
    }
}
