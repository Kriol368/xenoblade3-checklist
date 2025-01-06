<?php

namespace App\Controller;

use App\Entity\CharacterClass;
use App\Repository\ChallengeModeRepository;
use App\Repository\CharacterClassRepository;
use App\Repository\CharacterRepository;
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

    ){
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
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
