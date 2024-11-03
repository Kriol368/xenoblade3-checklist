<?php

// src/Controller/CharacterClassController.php
namespace App\Controller;

use App\Repository\CharacterClassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterClassController extends AbstractController
{
    private CharacterClassRepository $characterClassRepository;

    public function __construct(CharacterClassRepository $characterClassRepository)
    {
        $this->characterClassRepository = $characterClassRepository;
    }

    #[Route('/characterClass', name: 'app_character_class')]
    public function index(): Response
    {
        $characterClasses = $this->characterClassRepository->findAll();

        return $this->render('character_class/index.html.twig', [
            'characterClasses' => $characterClasses,
        ]);
    }
}
