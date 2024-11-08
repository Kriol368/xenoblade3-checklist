<?php

namespace App\Controller;

use App\Entity\UserGauntletEmblem;
use App\Repository\GauntletEmblemRepository;
use App\Repository\UserGauntletEmblemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    )
    {
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

        $gauntletEmblems = $this->gauntletEmblemRepository->findAll();
        $userGauntletEmblems = $this->userGauntletEmblemRepository->findBy(['user' => $currentUser]);
        $userGauntletEmblemMap = [];

        foreach ($userGauntletEmblems as $userGauntletEmblem) {
            $userChallengeModeMap[$userGauntletEmblem->getGauntletEmblem()->getId()] = $userGauntletEmblem;
        }
        return $this->render('gauntlet_emblem/index.html.twig', [
            'gauntletEmblems' => $gauntletEmblems,
            'userGauntletEmblemMap' => $userGauntletEmblemMap
        ]);
    }
}
