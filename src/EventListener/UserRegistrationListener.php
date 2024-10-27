<?php
// src/EventListener/UserRegistrationListener.php
namespace App\EventListener;

use App\Entity\User;
use App\Entity\Gem;
use App\Entity\UserGem;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\EntityManagerInterface;

class UserRegistrationListener
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function postPersist(PostPersistEventArgs $args): void
    {
        $entity = $args->getObject();

        // Check if the entity is an instance of User
        if (!$entity instanceof User) {
            return;
        }

        $user = $entity;
        $gemRepository = $this->entityManager->getRepository(Gem::class);
        $gems = $gemRepository->findAll();

        foreach ($gems as $gem) {
            $userGem = new UserGem();
            $userGem->setUser($user);
            $userGem->setGem($gem);
            $userGem->setLevel(0);

            $this->entityManager->persist($userGem);
        }

        $this->entityManager->flush();
    }
}
