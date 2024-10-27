<?php

namespace App\Entity;

use App\Repository\UserGauntletEmblemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserGauntletEmblemRepository::class)]
#[ORM\Table(name: "user_gauntlet_emblem")] // Optional: specify the table name
class UserGauntletEmblem
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private User $user;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: GauntletEmblem::class)]
    #[ORM\JoinColumn(name: "gauntlet_emblem_id", referencedColumnName: "id", nullable: false)]
    private GauntletEmblem $gauntletEmblem;

    #[ORM\Column(type: 'integer')]
    private ?int $level = null;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getGauntletEmblem(): GauntletEmblem
    {
        return $this->gauntletEmblem;
    }

    public function setGauntletEmblem(GauntletEmblem $gauntletEmblem): self
    {
        $this->gauntletEmblem = $gauntletEmblem;
        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;
        return $this;
    }
}
