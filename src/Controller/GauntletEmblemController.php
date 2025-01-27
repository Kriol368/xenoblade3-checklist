<?php

namespace App\Controller;

use App\Repository\GauntletEmblemRepository;
use App\Repository\UserGauntletEmblemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class GauntletEmblemController extends AbstractController
{

    private GauntletEmblemRepository $gauntletEmblemRepository;
    private UserGauntletEmblemRepository $userGauntletEmblemRepository;
    private EntityManagerInterface $entityManager;
    private CsrfTokenManagerInterface $csrfTokenManager;

    public function __construct(
        GauntletEmblemRepository     $gauntletEmblemRepository,
        UserGauntletEmblemRepository $userGauntletEmblemRepository,
        EntityManagerInterface      $entityManager,
        CsrfTokenManagerInterface   $csrfTokenManager
    ){
        $this->gauntletEmblemRepository = $gauntletEmblemRepository;
        $this->userGauntletEmblemRepository = $userGauntletEmblemRepository;
        $this->entityManager = $entityManager;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    #[Route('/gauntletEmblem', name: 'app_gauntlet_emblem')]
    public function index(): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            throw $this->createAccessDeniedException('User not logged in');
        }

        // Fetch all gauntlet emblems
        $gauntletEmblems = $this->gauntletEmblemRepository->findAll();

        // Fetch user gauntlet emblems and map them by gauntletEmblem id
        $userGauntletEmblems = $this->userGauntletEmblemRepository->findBy(['user' => $currentUser]);
        $userGauntletEmblemMap = [];

        foreach ($userGauntletEmblems as $userGauntletEmblem) {
            $userGauntletEmblemMap[$userGauntletEmblem->getGauntletEmblem()->getId()] = $userGauntletEmblem;
        }

        $checkedGauntletEmblemsCount = count(array_filter($userGauntletEmblems, fn($userGauntletEmblem) => $userGauntletEmblem->isChecked()));
        $totalGauntletEmblemsCount = count($gauntletEmblems);
        $progress = $totalGauntletEmblemsCount > 0 ? ($checkedGauntletEmblemsCount / $totalGauntletEmblemsCount) * 100 : 0;

        return $this->render('gauntlet_emblem/index.html.twig', [
            'gauntletEmblems' => $gauntletEmblems,
            'userGauntletEmblemMap' => $userGauntletEmblemMap,
            'progress' => $progress,
        ]);
    }


    #[Route('/update-emblem-status/{gauntletEmblemId}', name: 'update_emblem_status', methods: ['POST'])]
    public function updateStatus(int $gauntletEmblemId, Request $request): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            return $this->json(['success' => false, 'error' => 'User not logged in'], Response::HTTP_FORBIDDEN);
        }

        $userGauntletEmblem = $this->userGauntletEmblemRepository->findOneBy([
            'user' => $currentUser,
            'gauntletEmblem' => $gauntletEmblemId
        ]);

        if (!$userGauntletEmblem) {
            return $this->json(['success' => false, 'error' => 'User gauntlet emblem not found'], Response::HTTP_NOT_FOUND);
        }

        $csrfToken = $request->request->get('_csrf_token');
        if (!$this->csrfTokenManager->isTokenValid(new CsrfToken('update_emblem_status', $csrfToken))) {
            return $this->json(['success' => false, 'error' => 'Invalid CSRF token'], Response::HTTP_FORBIDDEN);
        }

        $isChecked = (bool) $request->request->get('value');
        $userGauntletEmblem->setChecked($isChecked);
        $this->entityManager->persist($userGauntletEmblem);
        $this->entityManager->flush();

        $totalGauntletEmblemsCount = $this->userGauntletEmblemRepository->count(['user' => $currentUser]); // Total gauntlet emblems for this user
        $checkedGauntletEmblems = $this->userGauntletEmblemRepository->count([
            'user' => $currentUser,
            'checked' => true
        ]); // Number of checked gauntlet emblems
        $progress = $totalGauntletEmblemsCount > 0 ? round(($checkedGauntletEmblems / $totalGauntletEmblemsCount) * 100) : 0;

        return $this->json([
            'success' => true,
            'message' => 'Gauntlet emblems status updated',
            'progress' => $progress
        ]);
    }
}
