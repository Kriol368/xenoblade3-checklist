<?php

namespace App\Controller;

use App\Repository\LandmarkLocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandmarkLocationController extends AbstractController
{
    private LandmarkLocationRepository $landmarkLocationRepository;

    public function __construct(LandmarkLocationRepository $landmarkLocationRepository)
    {
        $this->landmarkLocationRepository = $landmarkLocationRepository;
    }

    #[Route('/landmarkLocation', name: 'app_landmark_location')]
    public function index(): Response
    {
        $landmarkLocations = $this->landmarkLocationRepository->findAll();

        return $this->render('landmark_location/index.html.twig', [
            'landmarkLocations' => $landmarkLocations,
        ]);
    }
}
