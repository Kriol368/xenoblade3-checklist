<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollectibleController extends AbstractController
{
    #[Route('/collectible', name: 'app_collectible')]
    public function index(): Response
    {
        return $this->render('collectible/index.html.twig', [
            'controller_name' => 'CollectibleController',
        ]);
    }
}
