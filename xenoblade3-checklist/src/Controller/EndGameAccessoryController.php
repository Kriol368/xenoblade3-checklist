<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EndGameAccessoryController extends AbstractController
{
    #[Route('/endGameAccessory', name: 'app_end_game_accessory')]
    public function index(): Response
    {
        return $this->render('end_game_accessory/index.html.twig', [
            'controller_name' => 'EndGameAccessoryController',
        ]);
    }
}
