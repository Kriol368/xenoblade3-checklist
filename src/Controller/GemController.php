<?php

namespace App\Controller;

use App\Repository\GemRepository;
use App\Repository\UserGemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use function Symfony\Component\Translation\t;

class GemController extends AbstractController
{
    private GemRepository $gemRepository;
    private UserGemRepository $userGemRepository;
    private EntityManagerInterface $entityManager;
    private CsrfTokenManagerInterface $csrfTokenManager;

    public function __construct(GemRepository $gemRepository, UserGemRepository $userGemRepository, EntityManagerInterface $entityManager, CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->gemRepository = $gemRepository;
        $this->userGemRepository = $userGemRepository;
        $this->entityManager = $entityManager;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    #[Route('/gem', name: 'app_gem')]
    public function index(): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            throw $this->createAccessDeniedException('User not logged in');
        }

        $gems = $this->gemRepository->findAll();
        $userGems = $this->userGemRepository->findBy(['user' => $currentUser]);
        $userGemMap =  [];

        foreach ($userGems as $userGem) {{
            $userGemMap[$userGem->getGem()->getId()] = $userGem;
        }}

        return $this->render('gem/index.html.twig', [
            'gems' => $gems,
            'userGemMap' => $userGemMap,
            ]);
    }

    #[Route('/update-gem-status/{gemId}', name: 'update_gem_status', methods: ['POST'])]
    public function updateStatus(int $gemId, Request $request): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            return $this->json(['success' => false, 'error' => 'User not logged in'], Response::HTTP_FORBIDDEN);
        }

        $userGem = $this->userGemRepository->findOneBy([
            'user' => $currentUser,
            'gem' => $gemId
        ]);

        if (!$userGem) {
            return $this->json(['success' => false, 'error' => 'User gem not found'], Response::HTTP_NOT_FOUND);
        }

        $csrfToken = $request->request->get('_csrf_token');
        if (!$this->csrfTokenManager->isTokenValid(new CsrfToken('update_gem_status', $csrfToken))) {
            return $this->json(['success' => false, 'error' => 'Invalid CSRF token'], Response::HTTP_FORBIDDEN);
        }

        $field = $request->request->get('field');
        $value = $request->request->get('value');

        if ($field === 'checked') {
            $userGem->setChecked((bool)$value);
            $this->entityManager->persist($userGem);
            $this->entityManager->flush();

            return $this->json(['success' => true, 'message' => 'Soul tree status updated']);
        }

        return $this->json(['success' => false, 'error' => 'Invalid request'], Response::HTTP_BAD_REQUEST);
    }
}
