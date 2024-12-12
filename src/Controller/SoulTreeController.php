<?php

namespace App\Controller;

use App\Repository\SoulTreeRepository;
use App\Repository\UserSoulTreeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class SoulTreeController extends AbstractController
{
    private SoulTreeRepository $soulTreeRepository;
    private UserSoulTreeRepository $userSoulTreeRepository;
    private EntityManagerInterface $entityManager;
    private CsrfTokenManagerInterface $csrfTokenManager;

    public function __construct(
        SoulTreeRepository $soulTreeRepository,
        UserSoulTreeRepository $userSoulTreeRepository,
        EntityManagerInterface $entityManager,
        CsrfTokenManagerInterface $csrfTokenManager
    ){
        $this->soulTreeRepository = $soulTreeRepository;
        $this->userSoulTreeRepository = $userSoulTreeRepository;
        $this->entityManager = $entityManager;
        $this->csrfTokenManager = $csrfTokenManager;
    }
    #[Route('/soulTree', name: 'app_soul_tree')]
    public function index(): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            throw $this->createAccessDeniedException('User not logged in');
        }

        $soulTrees = $this->soulTreeRepository->findAll();
        $userSoulTrees = $this->userSoulTreeRepository->findBy(['user' => $currentUser]);
        $userSoulTreeMap = [];

        foreach ($userSoulTrees as $userSoulTree) {
            $userSoulTreeMap[$userSoulTree->getSoulTree()->getId()] = $userSoulTree;
        }
        $checkedSoulTreesCount = count(array_filter($userSoulTrees, fn($userSoulTree) => $userSoulTree->isChecked()));
        $totalSoulTreesCount = count($soulTrees);
        $progress = $totalSoulTreesCount > 0 ? ($checkedSoulTreesCount / $totalSoulTreesCount) * 100 : 0;

        return $this->render('soul_tree/index.html.twig', [
            'soulTrees' => $soulTrees,
            'userSoulTreesMap' => $userSoulTreeMap,
            'progress' => $progress,
        ]);
    }

    #[Route('/update-soul-status/{soulTreeId}', name: 'update_soul_status', methods: ['POST'])]
    public function updateStatus(int $soulTreeId, Request $request): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            return $this->json(['success' => false, 'error' => 'User not logged in'], Response::HTTP_FORBIDDEN);
        }

        $userSoulTree = $this->userSoulTreeRepository->findOneBy([
            'user' => $currentUser,
            'soulTree' => $soulTreeId
        ]);

        if (!$userSoulTree) {
            return $this->json(['success' => false, 'error' => 'User soul tree not found'], Response::HTTP_NOT_FOUND);
        }

        $csrfToken = $request->request->get('_csrf_token');
        if (!$this->csrfTokenManager->isTokenValid(new CsrfToken('update_soul_status', $csrfToken))) {
            return $this->json(['success' => false, 'error' => 'Invalid CSRF token'], Response::HTTP_FORBIDDEN);
        }

        $isChecked = (bool) $request->request->get('value');
        $userSoulTree->setChecked($isChecked);
        $this->entityManager->persist($userSoulTree);
        $this->entityManager->flush();

        $totalSoulTreesCount = $this->userSoulTreeRepository->count(['user' => $currentUser]); // Total soul trees for this user
        $checkedSoulTrees = $this->userSoulTreeRepository->count([
            'user' => $currentUser,
            'checked' => true
        ]); // Number of checked soul trees
        $progress = $totalSoulTreesCount > 0 ? round(($checkedSoulTrees / $totalSoulTreesCount) * 100) : 0;

        return $this->json([
            'success' => true,
            'message' => 'Soul trees status updated',
            'progress' => $progress
        ]);

    }
}
