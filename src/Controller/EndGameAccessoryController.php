<?php

namespace App\Controller;

use App\Repository\EndGameAccessoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EndGameAccessoryController extends AbstractController
{
    private EndGameAccessoryRepository $endGameAccessoryRepository;

    public function __construct(EndGameAccessoryRepository $endGameAccessoryRepository){
        $this->endGameAccessoryRepository = $endGameAccessoryRepository;
    }
    #[Route('/endGameAccessory', name: 'app_end_game_accessory')]
    public function index(): Response
    {
        $accessories = $this->endGameAccessoryRepository->findAll();

        return $this->render('end_game_accessory/index.html.twig', [
            'accessories' => $accessories,
        ]);
    }
}
