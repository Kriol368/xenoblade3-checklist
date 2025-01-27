<?php

// src/Controller/HeroController.php
namespace App\Controller;

use App\Repository\HeroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HeroController extends AbstractController
{
    private HeroRepository $heroRepository;

    public function __construct(HeroRepository $heroRepository)
    {
        $this->heroRepository = $heroRepository;
    }

    #[Route('/hero', name: 'app_hero')]
    public function index(): Response
    {
        $heroes = $this->heroRepository->findAll();

        return $this->render('hero/index.html.twig', [
            'heroes' => $heroes,
        ]);
    }
}
