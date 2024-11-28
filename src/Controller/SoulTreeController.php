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

        return $this->render('soul_tree/index.html.twig', [
            'soulTrees' => $soulTrees,
            'userSoulTreesMap' => $userSoulTreeMap,
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

        $field = $request->request->get('field');
        $value = $request->request->get('value');

        if ($field === 'checked') {
            $userSoulTree->setChecked((bool)$value);
            $this->entityManager->persist($userSoulTree);
            $this->entityManager->flush();

            return $this->json(['success' => true, 'message' => 'Soul tree status updated']);
        }

        return $this->json(['success' => false, 'error' => 'Invalid request'], Response::HTTP_BAD_REQUEST);
    }
}
