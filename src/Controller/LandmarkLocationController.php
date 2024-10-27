<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandmarkLocationController extends AbstractController
{
    #[Route('/landmarkLocation', name: 'app_landmark_location')]
    public function index(): Response
    {
        return $this->render('landmark_location/index.html.twig', [
            'controller_name' => 'LandmarkLocationController',
        ]);
    }
}
