<?php

namespace App\Entity;

use App\Repository\UserChallengeModeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserChallengeModeRepository::class)]
#[ORM\Table(name: "user_challenge_mode")] // Optional: specify the table name
class UserChallengeMode
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private User $user;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: ChallengeMode::class)]
    #[ORM\JoinColumn(name: "challenge_mode_id", referencedColumnName: "id", nullable: false)]
    private ChallengeMode $challengeMode;

    #[ORM\Column(type: 'boolean')]
    private bool $easy;

    #[ORM\Column(type: 'boolean')]
    private bool $normal;

    #[ORM\Column(type: 'boolean')]
    private bool $hard;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getChallengeMode(): ChallengeMode
    {
        return $this->challengeMode;
    }

    public function setChallengeMode(ChallengeMode $challengeMode): self
    {
        $this->challengeMode = $challengeMode;
        return $this;
    }

    public function isEasy(): bool
    {
        return $this->easy;
    }

    public function setEasy(bool $easy): self
    {
        $this->easy = $easy;
        return $this;
    }

    public function isNormal(): bool
    {
        return $this->normal;
    }

    public function setNormal(bool $normal): self
    {
        $this->normal = $normal;
        return $this;
    }

    public function isHard(): bool
    {
        return $this->hard;
    }

    public function setHard(bool $hard): self
    {
        $this->hard = $hard;
        return $this;
    }
}
