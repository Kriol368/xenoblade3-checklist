<?php

namespace App\Entity;

use App\Repository\UserQuestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserQuestRepository::class)]
#[ORM\Table(name: "user_quest")] // Optional: specify the table name
class UserQuest
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private User $user;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Quest::class)]
    #[ORM\JoinColumn(name: "quest_id", referencedColumnName: "id", nullable: false)]
    private Quest $quest;

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

    public function getQuest(): Quest
    {
        return $this->quest;
    }

    public function setQuest(Quest $quest): self
    {
        $this->quest = $quest;
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
