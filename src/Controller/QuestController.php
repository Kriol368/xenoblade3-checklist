<?php

namespace App\Controller;

use App\Repository\QuestRepository;
use App\Repository\UserQuestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/update-quest-status/{questId}', name: 'update_quest_status', methods: ['POST'])]
    public function updateStatus(int $questId, Request $request): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            return $this->json(['success' => false, 'error' => 'User not logged in'], Response::HTTP_FORBIDDEN);
        }

        $userQuest = $this->userQuestRepository->findOneBy([
            'user' => $currentUser,
            'quest' => $questId
        ]);

        if (!$userQuest) {
            return $this->json(['success' => false, 'error' => 'User quest not found'], Response::HTTP_NOT_FOUND);
        }

        $csrfToken = $request->request->get('_csrf_token');
        if (!$this->csrfTokenManager->isTokenValid(new CsrfToken('update_quest_status', $csrfToken))) {
            return $this->json(['success' => false, 'error' => 'Invalid CSRF token'], Response::HTTP_FORBIDDEN);
        }

        $field = $request->request->get('field');
        $value = $request->request->get('value');

        if ($field === 'checked') {
            $userQuest->setChecked((bool)$value);
            $this->entityManager->persist($userQuest);
            $this->entityManager->flush();

            return $this->json(['success' => true, 'message' => 'Quest status updated']);
        }

        return $this->json(['success' => false, 'error' => 'Invalid request'], Response::HTTP_BAD_REQUEST);
    }
}
