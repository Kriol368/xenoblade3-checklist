<?php

namespace App\Controller;

use App\Repository\QuestRepository;
use App\Repository\UserQuestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class QuestController extends AbstractController
{
    private QuestRepository $questRepository;
    private UserQuestRepository $userQuestRepository;
    private EntityManagerInterface $entityManager;
    private CsrfTokenManagerInterface $csrfTokenManager;

    public function __construct(
        QuestRepository $questRepository,
        UserQuestRepository $userQuestRepository,
        EntityManagerInterface $entityManager,
        CsrfTokenManagerInterface $csrfTokenManager
    ) {
        $this->questRepository = $questRepository;
        $this->userQuestRepository = $userQuestRepository;
        $this->entityManager = $entityManager;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    #[Route('/quest', name: 'app_quest')]
    public function index(): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            throw $this->createAccessDeniedException('User not logged in');
        }

        $quests =  $this->questRepository->findAll();
        $userQuests = $this->userQuestRepository->findBy(['user' => $currentUser]);
        $userQuestMap = [];

        foreach ($userQuests as $userQuest) {
            $userQuestMap[$userQuest->getQuest()->getId()] = $userQuest;
        }

        return $this->render('quest/index.html.twig', [
            'quests' => $quests,
            'userQuestMap' => $userQuestMap,
        ]);
    }
}
