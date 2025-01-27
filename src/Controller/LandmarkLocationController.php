<?php

namespace App\Controller;

use App\Repository\LandmarkLocationRepository;
use App\Repository\UserLandmarkLocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class LandmarkLocationController extends AbstractController
{
    private LandmarkLocationRepository $landmarkLocationRepository;
    private UserLandmarkLocationRepository $userLandmarkLocationRepository;
    private EntityManagerInterface $entityManager;
    private CsrfTokenManagerInterface $csrfTokenManager;

    public function __construct(
        LandmarkLocationRepository $landmarkLocationRepository,
        UserLandmarkLocationRepository $userLandmarkLocationRepository,
        EntityManagerInterface $entityManager,
        CsrfTokenManagerInterface $csrfTokenManager
    ) {
        $this->landmarkLocationRepository = $landmarkLocationRepository;
        $this->userLandmarkLocationRepository = $userLandmarkLocationRepository;
        $this->entityManager = $entityManager;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    #[Route('/landmarkLocation', name: 'app_landmark_location')]
    public function index(): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            throw $this->createAccessDeniedException('User not logged in');
        }

        $landmarkLocations = $this->landmarkLocationRepository->findAll();
        $userLandmarkLocations = $this->userLandmarkLocationRepository->findBy(['user' => $currentUser]);
        $userLandmarkLocationMap = [];

        foreach ($userLandmarkLocations as $userLandmarkLocation) {
            $userLandmarkLocationMap[$userLandmarkLocation->getLandmarkLocation()->getId()] = $userLandmarkLocation;
        }

        $checkedLandmarkLocationsCount = count(array_filter($userLandmarkLocations, fn($userLandmarkLocation) => $userLandmarkLocation->isChecked()));
        $totalLandmarkLocationsCount = count($landmarkLocations);
        $progress = $totalLandmarkLocationsCount > 0 ? ($checkedLandmarkLocationsCount / $totalLandmarkLocationsCount) * 100 : 0;

        return $this->render('landmark_location/index.html.twig', [
            'landmarkLocations' => $landmarkLocations,
            'userLandmarkLocationMap' => $userLandmarkLocationMap,
            'progress' => $progress,
        ]);
    }

    #[Route('/update-landmark-status/{landmarkLocationId}', name: 'update_landmark_status', methods: ['POST'])]
    public function updateStatus(int $landmarkLocationId, Request $request): Response
    {
        $currentUser = $this->getUser();
        if (!$currentUser) {
            return $this->json(['success' => false, 'error' => 'User not logged in'], Response::HTTP_FORBIDDEN);
        }

        $userLandmarkLocation = $this->userLandmarkLocationRepository->findOneBy([
            'user' => $currentUser,
            'landmarkLocation' => $landmarkLocationId
        ]);

        if (!$userLandmarkLocation) {
            return $this->json(['success' => false, 'error' => 'User landmark location not found'], Response::HTTP_NOT_FOUND);
        }

        $csrfToken = $request->request->get('_csrf_token');
        if (!$this->csrfTokenManager->isTokenValid(new CsrfToken('update_landmark_status', $csrfToken))) {
            return $this->json(['success' => false, 'error' => 'Invalid CSRF token'], Response::HTTP_FORBIDDEN);
        }

        $isChecked = (bool) $request->request->get('value');
        $userLandmarkLocation->setChecked($isChecked);
        $this->entityManager->persist($userLandmarkLocation);
        $this->entityManager->flush();

        $totalLandmarkLocationsCount = $this->userLandmarkLocationRepository->count(['user' => $currentUser]); // Total landmark locations for this user
        $checkedLandmarkLocations = $this->userLandmarkLocationRepository->count([
            'user' => $currentUser,
            'checked' => true
        ]); // Number of checked landmark locations
        $progress = $totalLandmarkLocationsCount > 0 ? round(($checkedLandmarkLocations / $totalLandmarkLocationsCount) * 100) : 0;

        return $this->json([
            'success' => true,
            'message' => 'Landmark locations status updated',
            'progress' => $progress
        ]);
    }
}
