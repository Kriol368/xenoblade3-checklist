<?php

namespace App\Controller;

use App\Repository\UniqueMonsterRepository;
use App\Repository\UserUniqueMonsterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class UniqueMonsterController extends AbstractController
{
    private UniqueMonsterRepository $uniqueMonsterRepository;
    private UserUniqueMonsterRepository $userUniqueMonsterRepository;
    private EntityManagerInterface $entityManager;
    private CsrfTokenManagerInterface $csrfTokenManager;
    public function __construct(
        UniqueMonsterRepository $uniqueMonsterRepository,
        UserUniqueMonsterRepository $userUniqueMonsterRepository,
        EntityManagerInterface $entityManager,
        CsrfTokenManagerInterface $csrfTokenManager
    )
    {
        $this->uniqueMonsterRepository = $uniqueMonsterRepository;
        $this->userUniqueMonsterRepository = $userUniqueMonsterRepository;
        $this->entityManager = $entityManager;
        $this->csrfTokenManager = $csrfTokenManager;
    }
    #[Route('/uniqueMonster', name: 'app_unique_monster')]
    public function index(): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            throw $this->createAccessDeniedException('User not logged in!');
        }
        $uniqueMonsters = $this->uniqueMonsterRepository->findAll();
        $userUniqueMonsters = $this->userUniqueMonsterRepository->findBy(['user' => $currentUser]);
        $userUniqueMonsterMap = [];
        $overallProgress = 0;


        foreach ($userUniqueMonsters as $userUniqueMonster) {
            $userUniqueMonsterMap[$userUniqueMonster->getUniqueMonster()->getId()] = $userUniqueMonster;
            $progress = 0;
            $progress += $userUniqueMonster->isDefeated() ? 33.33 : 0;
            $progress += $userUniqueMonster->isSoulHacked() ? 33.33 : 0;
            $progress += $userUniqueMonster->isAbilityUpgraded() ? 33.34 : 0;
            $overallProgress += $progress;
        }

        $totalMonsters = count($uniqueMonsters);
        $averageProgress = $totalMonsters > 0 ? round($overallProgress / $totalMonsters, 2) : 0;

        return $this->render('unique_monster/index.html.twig', [
            'uniqueMonsters' => $uniqueMonsters,
            'userUniqueMonsterMap' => $userUniqueMonsterMap,
            'progress' => $averageProgress,
        ]);
    }

    #[Route('/update-monster-status/{uniqueMonsterId}', name: 'update_monster_status', methods: ['POST'])]
    public function updateStatus(int $uniqueMonsterId, Request $request): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            return $this->json(['success' => false, 'error' => 'User not logged in'], Response::HTTP_FORBIDDEN);
        }

        $userUniqueMonster = $this->userUniqueMonsterRepository->findOneBy([
            'user' => $currentUser,
            'uniqueMonster' => $uniqueMonsterId
        ]);

        if (!$userUniqueMonster) {
            return $this->json(['success' => false, 'error' => 'User unique monster not found'], Response::HTTP_NOT_FOUND);
        }

        $csrfToken = $request->request->get('_csrf_token');
        if (!$this->csrfTokenManager->isTokenValid(new CsrfToken('update_monster_status', $csrfToken))) {
            return $this->json(['success' => false, 'error' => 'Invalid CSRF token'], Response::HTTP_FORBIDDEN);
        }

        $field = $request->request->get('field');
        $value = $request->request->get('value');
        $validFields = ['defeated', 'soulHacked', 'abilityUpgraded'];

        if ($field && in_array($field, $validFields, true)) {
            $setter = 'set' . ucfirst($field);
            if (method_exists($userUniqueMonster, $setter)) {
                $userUniqueMonster->$setter((bool)$value);
                $this->entityManager->persist($userUniqueMonster);
                $this->entityManager->flush();

                $progress = 0;
                $progress += $userUniqueMonster->isDefeated() ? 33.33 : 0;
                $progress += $userUniqueMonster->isSoulHacked() ? 33.33 : 0;
                $progress += $userUniqueMonster->isAbilityUpgraded() ? 33.34 : 0;

                return $this->json([
                    'success' => true,
                    'message' => ucfirst($field) . ' status updated',
                    'progress' => $progress,
                ]);
            }
        }

        return $this->json(['success' => false, 'error' => 'Invalid request'], Response::HTTP_BAD_REQUEST);
    }
}
