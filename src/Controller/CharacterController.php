<?php

namespace App\Controller;

use App\Repository\CharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends AbstractController
{
    private CharacterRepository $characterRepository;

    public function __construct(CharacterRepository $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    #[Route('/character', name: 'app_character')]
    public function index(): Response
    {
        $characters = $this->characterRepository->findAll();

        return $this->render('character/index.html.twig', [
            'characters' => $characters,
        ]);
    }
}
