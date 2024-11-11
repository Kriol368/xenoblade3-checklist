<?php

namespace App\Controller;

use App\Repository\GauntletEmblemRepository;
use App\Repository\UserGauntletEmblemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
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

        // Fetch all gauntlet emblems
        $gauntletEmblems = $this->gauntletEmblemRepository->findAll();

        // Fetch user gauntlet emblems and map them by gauntletEmblem id
        $userGauntletEmblems = $this->userGauntletEmblemRepository->findBy(['user' => $currentUser]);
        $userGauntletEmblemMap = [];

        // Map gauntletEmblem id to their corresponding userGauntletEmblem entity with level
        foreach ($userGauntletEmblems as $userGauntletEmblem) {
            $gauntletEmblemId = $userGauntletEmblem->getGauntletEmblem()->getId();
            $userGauntletEmblemMap[$gauntletEmblemId] = [
                'userGauntletEmblem' => $userGauntletEmblem,  // Store the full UserGauntletEmblem object
                'level' => $userGauntletEmblem->getLevel()   // Store the level directly
            ];
        }

        return $this->render('gauntlet_emblem/index.html.twig', [
            'gauntletEmblems' => $gauntletEmblems,
            'userGauntletEmblemMap' => $userGauntletEmblemMap
        ]);
    }


    #[Route('/update-emblem-status/{gauntletEmblemId}', name: 'update_emblem_status', methods: ['POST'])]
    public function updateStatus(int $gauntletEmblemId, Request $request): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            return $this->json(['success' => false, 'error' => 'User not logged in'], Response::HTTP_FORBIDDEN);
        }

        $userGauntletEmblem = $this->userGauntletEmblemRepository->findOneBy([
            'user' => $currentUser,
            'gauntletEmblem' => $gauntletEmblemId
        ]);

        if (!$userGauntletEmblem) {
            return $this->json(['success' => false, 'error' => 'User gauntlet emblem not found'], Response::HTTP_NOT_FOUND);
        }

        $csrfToken = $request->request->get('_csrf_token');
        if (!$this->csrfTokenManager->isTokenValid(new CsrfToken('update_emblem_status', $csrfToken))) {
            return $this->json(['success' => false, 'error' => 'Invalid CSRF token'], Response::HTTP_FORBIDDEN);
        }

        $field = $request->request->get('field');
        $value = $request->request->get('value');
        $validFields = ['easy', 'normal', 'hard'];

        if ($field && in_array($field, $validFields, true)) {
            $setter = 'set' . ucfirst($field);
            if (method_exists($userGauntletEmblem, $setter)) {
                $userGauntletEmblem->$setter((bool)$value);
                $this->entityManager->persist($userGauntletEmblem);
                $this->entityManager->flush();

                return $this->json(['success' => true, 'message' => ucfirst($field) . ' status updated']);
            }
        }

        return $this->json(['success' => false, 'error' => 'Invalid request'], Response::HTTP_BAD_REQUEST);
    }
}
