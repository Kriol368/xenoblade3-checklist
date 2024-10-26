<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GauntletEmblemController extends AbstractController
{
    #[Route('/gauntletEmblem', name: 'app_gauntlet_emblem')]
    public function index(): Response
    {
        return $this->render('gauntlet_emblem/index.html.twig', [
            'controller_name' => 'GauntletEmblemController',
        ]);
    }
}
