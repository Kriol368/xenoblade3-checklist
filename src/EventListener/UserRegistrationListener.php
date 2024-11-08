<?php
// src/EventListener/UserRegistrationListener.php
namespace App\EventListener;

use App\Entity\ChallengeMode;
use App\Entity\CharacterClass;
use App\Entity\GauntletEmblem;
use App\Entity\Gem;
use App\Entity\LandmarkLocation;
use App\Entity\Quest;
use App\Entity\SoulTree;
use App\Entity\UniqueMonster;
use App\Entity\User;
use App\Entity\UserChallengeMode;
use App\Entity\UserCharacterClass;
use App\Entity\UserGauntletEmblem;
use App\Entity\UserGem;
use App\Entity\UserLandmarkLocation;
use App\Entity\UserQuest;
use App\Entity\UserSoulTree;
use App\Entity\UserUniqueMonster;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PostPersistEventArgs;

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

        if (!$entity instanceof User) {
            return;
        }

        $user = $entity;

        // Initialize each many-to-many relationship
        $this->initializeUserGems($user);
        $this->initializeUserSoulTrees($user);
        $this->initializeUserChallengeModes($user);
        $this->initializeUserCharacterClasses($user);
        $this->initializeUserGauntletEmblems($user);
        $this->initializeUserLandmarkLocations($user);
        $this->initializeUserQuests($user);
        $this->initializeUserUniqueMonsters($user); // Add this line for user unique monsters

        // Flush after setting up all relations
        $this->entityManager->flush();
    }

    private function initializeUserGems(User $user): void
    {
        $gems = $this->entityManager->getRepository(Gem::class)->findAll();

        foreach ($gems as $gem) {
            $userGem = new UserGem();
            $userGem->setUser($user);
            $userGem->setGem($gem);
            $userGem->setLevel(0); // Default level

            $this->entityManager->persist($userGem);
        }
    }

    private function initializeUserSoulTrees(User $user): void
    {
        $soulTrees = $this->entityManager->getRepository(SoulTree::class)->findAll();

        foreach ($soulTrees as $soulTree) {
            $userSoulTree = new UserSoulTree();
            $userSoulTree->setUser($user);
            $userSoulTree->setSoulTree($soulTree);
            $userSoulTree->setCheck(false); // Default check value

            $this->entityManager->persist($userSoulTree);
        }
    }

    private function initializeUserChallengeModes(User $user): void
    {
        $challengeModes = $this->entityManager->getRepository(ChallengeMode::class)->findAll();

        foreach ($challengeModes as $challengeMode) {
            $userChallengeMode = new UserChallengeMode();
            $userChallengeMode->setUser($user);
            $userChallengeMode->setChallengeMode($challengeMode);
            $userChallengeMode->setEasy(false); // Default easy value
            $userChallengeMode->setNormal(false); // Default normal value
            $userChallengeMode->setHard(false); // Default hard value

            $this->entityManager->persist($userChallengeMode);
        }
    }

    private function initializeUserCharacterClasses(User $user): void
    {
        $characterClasses = $this->entityManager->getRepository(CharacterClass::class)->findAll();

        foreach ($characterClasses as $characterClass) {
            $userCharacterClass = new UserCharacterClass();
            $userCharacterClass->setUser($user);
            $userCharacterClass->setCharacterClass($characterClass);
            $userCharacterClass->setUnlocked(false); // Default unlocked value
            $userCharacterClass->setAscended(false); // Default ascended value
            $userCharacterClass->setNoah(false); // Default Noah value
            $userCharacterClass->setMio(false); // Default Mio value
            $userCharacterClass->setEunie(false); // Default Eunie value
            $userCharacterClass->setTaion(false); // Default Taion value
            $userCharacterClass->setLanz(false); // Default Lanz value
            $userCharacterClass->setSena(false); // Default Sena value

            $this->entityManager->persist($userCharacterClass);
        }
    }

    private function initializeUserGauntletEmblems(User $user): void
    {
        $gauntletEmblems = $this->entityManager->getRepository(GauntletEmblem::class)->findAll();

        foreach ($gauntletEmblems as $gauntletEmblem) {
            $userGauntletEmblem = new UserGauntletEmblem();
            $userGauntletEmblem->setUser($user);
            $userGauntletEmblem->setGauntletEmblem($gauntletEmblem);
            $userGauntletEmblem->setLevel(0); // Default level

            $this->entityManager->persist($userGauntletEmblem);
        }
    }

    private function initializeUserLandmarkLocations(User $user): void
    {
        $landmarkLocations = $this->entityManager->getRepository(LandmarkLocation::class)->findAll();

        foreach ($landmarkLocations as $landmarkLocation) {
            $userLandmarkLocation = new UserLandmarkLocation();
            $userLandmarkLocation->setUser($user);
            $userLandmarkLocation->setLandmarkLocation($landmarkLocation);
            $userLandmarkLocation->setCheck(false); // Default check value

            $this->entityManager->persist($userLandmarkLocation);
        }
    }

    private function initializeUserQuests(User $user): void
    {
        $quests = $this->entityManager->getRepository(Quest::class)->findAll();

        foreach ($quests as $quest) {
            $userQuest = new UserQuest();
            $userQuest->setUser($user);
            $userQuest->setQuest($quest);
            $userQuest->setCheck(false); // Default check value

            $this->entityManager->persist($userQuest);
        }
    }

    private function initializeUserUniqueMonsters(User $user): void
    {
        $uniqueMonsters = $this->entityManager->getRepository(UniqueMonster::class)->findAll();

        foreach ($uniqueMonsters as $uniqueMonster) {
            $userUniqueMonster = new UserUniqueMonster();
            $userUniqueMonster->setUser($user);
            $userUniqueMonster->setUniqueMonster($uniqueMonster);
            $userUniqueMonster->setDefeated(false); // Default defeated value
            $userUniqueMonster->setSoulHacked(false); // Default soul hacked value
            $userUniqueMonster->setAbilityUpgraded(false); // Default ability upgraded value

            $this->entityManager->persist($userUniqueMonster);
        }
    }
}
