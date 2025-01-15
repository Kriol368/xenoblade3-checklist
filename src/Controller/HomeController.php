<?php

namespace App\Controller;

use App\Repository\ChallengeModeRepository;
use App\Repository\CharacterClassRepository;
use App\Repository\GauntletEmblemRepository;
use App\Repository\GemRepository;
use App\Repository\LandmarkLocationRepository;
use App\Repository\QuestRepository;
use App\Repository\SoulTreeRepository;
use App\Repository\UniqueMonsterRepository;
use App\Repository\UserChallengeModeRepository;
use App\Repository\UserCharacterClassRepository;
use App\Repository\UserGauntletEmblemRepository;
use App\Repository\UserGemRepository;
use App\Repository\UserLandmarkLocationRepository;
use App\Repository\UserQuestRepository;
use App\Repository\UserSoulTreeRepository;
use App\Repository\UserUniqueMonsterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private CharacterClassRepository $characterClassRepository;
    private UserCharacterClassRepository $userCharacterClassRepository;
    private QuestRepository $questRepository;
    private UserQuestRepository $userQuestRepository;
    private GemRepository $gemRepository;
    private UserGemRepository $userGemRepository;
    private SoulTreeRepository $soulTreeRepository;
    private UserSoulTreeRepository $userSoulTreeRepository;
    private LandmarkLocationRepository $landmarkLocationRepository;
    private UserLandmarkLocationRepository $userLandmarkLocationRepository;
    private UniqueMonsterRepository $uniqueMonsterRepository;
    private UserUniqueMonsterRepository $userUniqueMonsterRepository;
    private ChallengeModeRepository $challengeModeRepository;
    private UserChallengeModeRepository $userChallengeModeRepository;
    private GauntletEmblemRepository $gauntletEmblemRepository;
    private UserGauntletEmblemRepository $userGauntletEmblemRepository;

    public function __construct(
        CharacterClassRepository $characterClassRepository,
        UserCharacterClassRepository $userCharacterClassRepository,
        QuestRepository $questRepository,
        UserQuestRepository $userQuestRepository,
        GemRepository $gemRepository,
        UserGemRepository $userGemRepository,
        SoulTreeRepository $soulTreeRepository,
        UserSoulTreeRepository $userSoulTreeRepository,
        LandmarkLocationRepository $landmarkLocationRepository,
        UserLandmarkLocationRepository $userLandmarkLocationRepository,
        UniqueMonsterRepository $uniqueMonsterRepository,
        UserUniqueMonsterRepository $userUniqueMonsterRepository,
        ChallengeModeRepository $challengeModeRepository,
        UserChallengeModeRepository $userChallengeModeRepository,
        GauntletEmblemRepository $gauntletEmblemRepository,
        UserGauntletEmblemRepository $userGauntletEmblemRepository,
    ) {
        $this->characterClassRepository = $characterClassRepository;
        $this->userCharacterClassRepository = $userCharacterClassRepository;
        $this->questRepository = $questRepository;
        $this->userQuestRepository = $userQuestRepository;
        $this->gemRepository = $gemRepository;
        $this->userGemRepository = $userGemRepository;
        $this->soulTreeRepository = $soulTreeRepository;
        $this->userSoulTreeRepository = $userSoulTreeRepository;
        $this->landmarkLocationRepository = $landmarkLocationRepository;
        $this->userLandmarkLocationRepository = $userLandmarkLocationRepository;
        $this->uniqueMonsterRepository = $uniqueMonsterRepository;
        $this->userUniqueMonsterRepository = $userUniqueMonsterRepository;
        $this->challengeModeRepository = $challengeModeRepository;
        $this->userChallengeModeRepository = $userChallengeModeRepository;
        $this->gauntletEmblemRepository = $gauntletEmblemRepository;
        $this->userGauntletEmblemRepository = $userGauntletEmblemRepository;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            throw $this->createAccessDeniedException('User not logged in');
        }

        $characterClasses = $this->characterClassRepository->findAll();
        // Fetch UserCharacterClass records for the current user
        $userCharacterClasses = $this->userCharacterClassRepository->findBy(['user' => $currentUser]);
        $overallClassProgress = 0;
        foreach ($userCharacterClasses as $userCharacterClass) {
            $classProgress = 0;
            $classProgress += $userCharacterClass->isUnlocked() ? 12.5 : 0;
            $classProgress += $userCharacterClass->isAscended() ? 12.5 : 0;
            $classProgress += $userCharacterClass->isNoah() ? 12.5 : 0;
            $classProgress += $userCharacterClass->isMio() ? 12.5 : 0;
            $classProgress += $userCharacterClass->isEunie() ? 12.5 : 0;
            $classProgress += $userCharacterClass->isTaion() ? 12.5 : 0;
            $classProgress += $userCharacterClass->isLanz() ? 12.5 : 0;
            $classProgress += $userCharacterClass->isSena() ? 12.5 : 0;
            $overallClassProgress += $classProgress;
        }
        $totalClasses = count($characterClasses);
        $averageClassProgress = $totalClasses > 0 ? round($overallClassProgress / $totalClasses, 2) : 0;

        $quests = $this->questRepository->findAll();
        $userQuests = $this->userQuestRepository->findBy(['user' => $currentUser]);
        $checkedQuestsCount = count(array_filter($userQuests, fn ($userQuest) => $userQuest->isChecked()));
        $totalQuestsCount = count($quests);
        $questProgress = $totalQuestsCount > 0 ? ($checkedQuestsCount / $totalQuestsCount) * 100 : 0;

        $gems = $this->gemRepository->findAll();
        $userGems = $this->userGemRepository->findBy(['user' => $currentUser]);
        $checkedGemsCount = count(array_filter($userGems, fn ($userGem) => $userGem->isChecked()));
        $totalGemsCount = count($gems);
        $gemProgress = $totalGemsCount > 0 ? round(($checkedGemsCount / $totalGemsCount) * 100) : 0;

        $soulTrees = $this->soulTreeRepository->findAll();
        $userSoulTrees = $this->userSoulTreeRepository->findBy(['user' => $currentUser]);
        $checkedSoulTreesCount = count(array_filter($userSoulTrees, fn ($userSoulTree) => $userSoulTree->isChecked()));
        $totalSoulTreesCount = count($soulTrees);
        $soulProgress = $totalSoulTreesCount > 0 ? ($checkedSoulTreesCount / $totalSoulTreesCount) * 100 : 0;

        $landmarkLocations = $this->landmarkLocationRepository->findAll();
        $userLandmarkLocations = $this->userLandmarkLocationRepository->findBy(['user' => $currentUser]);
        $checkedLandmarkLocationsCount = count(array_filter($userLandmarkLocations, fn ($userLandmarkLocation) => $userLandmarkLocation->isChecked()));
        $totalLandmarkLocationsCount = count($landmarkLocations);
        $landmarkProgress = $totalLandmarkLocationsCount > 0 ? ($checkedLandmarkLocationsCount / $totalLandmarkLocationsCount) * 100 : 0;

        $uniqueMonsters = $this->uniqueMonsterRepository->findAll();
        $userUniqueMonsters = $this->userUniqueMonsterRepository->findBy(['user' => $currentUser]);
        $overallMonsterProgress = 0;
        foreach ($userUniqueMonsters as $userUniqueMonster) {
            $monsterProgress = 0;
            $monsterProgress += $userUniqueMonster->isDefeated() ? 33.33 : 0;
            $monsterProgress += $userUniqueMonster->isSoulHacked() ? 33.33 : 0;
            $monsterProgress += $userUniqueMonster->isAbilityUpgraded() ? 33.34 : 0;
            $overallMonsterProgress += $monsterProgress;
        }
        $totalMonsters = count($uniqueMonsters);
        $averageMonsterProgress = $totalMonsters > 0 ? round($overallMonsterProgress / $totalMonsters, 2) : 0;

        $challengeModes = $this->challengeModeRepository->findAll();
        $userChallengeModes = $this->userChallengeModeRepository->findBy(['user' => $currentUser]);
        $overallChallengeProgress = 0;
        foreach ($userChallengeModes as $userChallengeMode) {
            $challengeProgress = 0;
            $challengeProgress += $userChallengeMode->isEasy() ? 33.33 : 0;
            $challengeProgress += $userChallengeMode->isNormal() ? 33.33 : 0;
            $challengeProgress += $userChallengeMode->isHard() ? 33.34 : 0;
            $overallChallengeProgress += $challengeProgress;
        }
        $totalChallenges = count($challengeModes);
        $averageChallengeProgress = $totalChallenges > 0 ? round($overallChallengeProgress / $totalChallenges, 2) : 0;

        $gauntletEmblems = $this->gauntletEmblemRepository->findAll();
        $userGauntletEmblems = $this->userGauntletEmblemRepository->findBy(['user' => $currentUser]);
        $checkedGauntletEmblemsCount = count(array_filter($userGauntletEmblems, fn ($userGauntletEmblem) => $userGauntletEmblem->isChecked()));
        $totalGauntletEmblemsCount = count($gauntletEmblems);
        $gauntletProgress = $totalGauntletEmblemsCount > 0 ? ($checkedGauntletEmblemsCount / $totalGauntletEmblemsCount) * 100 : 0;

        return $this->render('home/index.html.twig', [
            'classProgress' => $averageClassProgress,
            'questProgress' => $questProgress,
            'gemProgress' => $gemProgress,
            'soulProgress' => $soulProgress,
            'landmarkProgress' => $landmarkProgress,
            'monsterProgress' => $averageMonsterProgress,
            'challengeProgress' => $averageChallengeProgress,
            'gauntletProgress' => $gauntletProgress,
            'overallProgress' => round((
                $averageClassProgress +
                $questProgress +
                $gemProgress +
                $soulProgress +
                $landmarkProgress +
                $averageMonsterProgress +
                $averageChallengeProgress +
                $gauntletProgress
            ) / 8),
        ]);
    }
}
