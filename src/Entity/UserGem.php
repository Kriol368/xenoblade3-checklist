<?php

namespace App\Entity;

use App\Repository\UserGemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserGemRepository::class)]
#[ORM\Table(name: "user_gem")] // Optional: specify the table name
class UserGem
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private User $user;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Gem::class)]
    #[ORM\JoinColumn(name: "gem_id", referencedColumnName: "id", nullable: false)]
    private Gem $gem;

    #[ORM\Column(type: 'boolean')]
    private bool $checked;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getGem(): Gem
    {
        return $this->gem;
    }

    public function setGem(Gem $gem): self
    {
        $this->gem = $gem;
        return $this;
    }

    public function isChecked(): bool
    {
        return $this->checked;
    }

    public function setChecked(bool $checked): self
    {
        $this->checked = $checked;
        return $this;
    }
}
