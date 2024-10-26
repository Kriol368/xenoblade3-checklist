<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtController extends AbstractController
{
    #[Route('/art', name: 'app_art')]
    public function index(): Response
    {
        return $this->render('art/index.html.twig', [
            'controller_name' => 'ArtController',
        ]);
    }
}
