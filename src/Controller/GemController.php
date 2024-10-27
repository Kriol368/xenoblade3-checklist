<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GemController extends AbstractController
{
    #[Route('/gem', name: 'app_gem')]
    public function index(): Response
    {
        return $this->render('gem/index.html.twig', [
            'controller_name' => 'GemController',
        ]);
    }
}
