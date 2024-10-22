<?php

namespace App\Entity;

use App\Repository\UserLandmarkLocationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserLandmarkLocationRepository::class)]
#[ORM\Table(name: "user_landmark_location")] // Optional: specify the table name
class UserLandmarkLocation
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private User $user;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: LandmarkLocation::class)]
    #[ORM\JoinColumn(name: "landmark_location_id", referencedColumnName: "id", nullable: false)]
    private LandmarkLocation $landmarkLocation;

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

    public function getLandmarkLocation(): LandmarkLocation
    {
        return $this->landmarkLocation;
    }

    public function setLandmarkLocation(LandmarkLocation $landmarkLocation): self
    {
        $this->landmarkLocation = $landmarkLocation;
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
