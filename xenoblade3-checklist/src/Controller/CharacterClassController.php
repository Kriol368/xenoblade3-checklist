<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterClassController extends AbstractController
{
    #[Route('/characterClass', name: 'app_character_class')]
    public function index(): Response
    {
        return $this->render('character_class/index.html.twig', [
            'controller_name' => 'CharacterClassController',
        ]);
    }
}
