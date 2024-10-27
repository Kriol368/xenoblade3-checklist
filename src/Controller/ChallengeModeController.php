<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChallengeModeController extends AbstractController
{
    #[Route('/challengeMode', name: 'app_challenge_mode')]
    public function index(): Response
    {
        return $this->render('challenge_mode/index.html.twig', [
            'controller_name' => 'ChallengeModeController',
        ]);
    }
}
