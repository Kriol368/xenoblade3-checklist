<?php

namespace App\Controller;

use App\Repository\GemRepository;
use App\Repository\UserGemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
}
