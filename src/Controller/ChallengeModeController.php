<?php

namespace App\Controller;

use App\Repository\ChallengeModeRepository;
use App\Repository\UserChallengeModeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class ChallengeModeController extends AbstractController
{
    private ChallengeModeRepository $challengeModeRepository;
    private UserChallengeModeRepository $userChallengeModeRepository;
    private EntityManagerInterface $entityManager;
    private CsrfTokenManagerInterface $csrfTokenManager;

    public function __construct(
        ChallengeModeRepository     $challengeModeRepository,
        UserChallengeModeRepository $userChallengeModeRepository,
        EntityManagerInterface      $entityManager,
        CsrfTokenManagerInterface   $csrfTokenManager
    )
    {
        $this->challengeModeRepository = $challengeModeRepository;
        $this->userChallengeModeRepository = $userChallengeModeRepository;
        $this->entityManager = $entityManager;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    #[Route('/challengeMode', name: 'app_challenge_mode')]
    public function index(): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            throw $this->createAccessDeniedException('User not logged in');
        }

        $challengeModes = $this->challengeModeRepository->findAll();
        $userChallengeModes = $this->userChallengeModeRepository->findBy(['user' => $currentUser]);
        $userChallengeModeMap = [];

        foreach ($userChallengeModes as $userChallengeMode) {
            $userChallengeModeMap[$userChallengeMode->getChallengeMode()->getId()] = $userChallengeMode;
        }

        return $this->render('challenge_mode/index.html.twig', [
            'challengeModes' => $challengeModes,
            'userChallengeModeMap' => $userChallengeModeMap
        ]);
    }

    #[Route('/update-challenge-status/{challengeModeId}', name: 'update_challenge_status', methods: ['POST'])]
    public function updateStatus(int $challengeModeId, Request $request): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            return $this->json(['success' => false, 'error' => 'User not logged in'], Response::HTTP_FORBIDDEN);
        }

        $userChallengeMode = $this->userChallengeModeRepository->findOneBy([
            'user' => $currentUser,
            'challengeMode' => $challengeModeId
        ]);

        if (!$userChallengeMode) {
            return $this->json(['success' => false, 'error' => 'User challenge mode not found'], Response::HTTP_NOT_FOUND);
        }

        $csrfToken = $request->request->get('_csrf_token');
        if (!$this->csrfTokenManager->isTokenValid(new CsrfToken('update_challenge_status', $csrfToken))) {
            return $this->json(['success' => false, 'error' => 'Invalid CSRF token'], Response::HTTP_FORBIDDEN);
        }

        $field = $request->request->get('field');
        $value = $request->request->get('value');
        $validFields = ['easy', 'normal', 'hard'];

        if ($field && in_array($field, $validFields, true)) {
            $setter = 'set' . ucfirst($field);
            if (method_exists($userChallengeMode, $setter)) {
                $userChallengeMode->$setter((bool)$value);
                $this->entityManager->persist($userChallengeMode);
                $this->entityManager->flush();

                return $this->json(['success' => true, 'message' => ucfirst($field) . ' status updated']);
            }
        }

        return $this->json(['success' => false, 'error' => 'Invalid request'], Response::HTTP_BAD_REQUEST);
    }
}
