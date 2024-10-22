<?php

namespace App\Entity;

use App\Repository\UserSoulTreeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserSoulTreeRepository::class)]
#[ORM\Table(name: "user_soul_tree")] // Optional: specify the table name
class UserSoulTree
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private User $user;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: SoulTree::class)]
    #[ORM\JoinColumn(name: "soul_tree_id", referencedColumnName: "id", nullable: false)]
    private SoulTree $soulTree;

    #[ORM\Column(type: 'boolean')]
    private bool $check;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getSoulTree(): SoulTree
    {
        return $this->soulTree;
    }

    public function setSoulTree(SoulTree $soulTree): self
    {
        $this->soulTree = $soulTree;
        return $this;
    }

    public function isCheck(): bool
    {
        return $this->check;
    }

    public function setCheck(bool $check): self
    {
        $this->check = $check;
        return $this;
    }
}
