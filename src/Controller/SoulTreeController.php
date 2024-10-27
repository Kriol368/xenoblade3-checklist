<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SoulTreeController extends AbstractController
{
    #[Route('/soulTree', name: 'app_soul_tree')]
    public function index(): Response
    {
        return $this->render('soul_tree/index.html.twig', [
            'controller_name' => 'SoulTreeController',
        ]);
    }
}
