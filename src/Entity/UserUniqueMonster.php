<?php

namespace App\Entity;

use App\Repository\UserUniqueMonsterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserUniqueMonsterRepository::class)]
#[ORM\Table(name: "user_unique_monster")] // Optional: specify the table name
class UserUniqueMonster
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private User $user;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: UniqueMonster::class)]
    #[ORM\JoinColumn(name: "unique_monster_id", referencedColumnName: "id", nullable: false)]
    private UniqueMonster $uniqueMonster;

    #[ORM\Column(type: 'boolean')]
    private bool $defeated;

    #[ORM\Column(type: 'boolean')]
    private bool $soulHacked;

    #[ORM\Column(type: 'boolean')]
    private bool $abilityUpgraded;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getUniqueMonster(): UniqueMonster
    {
        return $this->uniqueMonster;
    }

    public function setUniqueMonster(UniqueMonster $uniqueMonster): self
    {
        $this->uniqueMonster = $uniqueMonster;
        return $this;
    }

    public function isDefeated(): bool
    {
        return $this->defeated;
    }

    public function setDefeated(bool $defeated): self
    {
        $this->defeated = $defeated;
        return $this;
    }

    public function isSoulHacked(): bool
    {
        return $this->soulHacked;
    }

    public function setSoulHacked(bool $soulHacked): self
    {
        $this->soulHacked = $soulHacked;
        return $this;
    }

    public function isAbilityUpgraded(): bool
    {
        return $this->abilityUpgraded;
    }

    public function setAbilityUpgraded(bool $abilityUpgraded): self
    {
        $this->abilityUpgraded = $abilityUpgraded;
        return $this;
    }
}
