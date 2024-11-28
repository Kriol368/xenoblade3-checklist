<?php

namespace App\Controller;

use App\Repository\SoulTreeRepository;
use App\Repository\UserRepository;
use App\Repository\UserSoulTreeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Twig\Node\Expression\Binary\SubBinary;

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
}
