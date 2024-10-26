<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UniqueMonsterController extends AbstractController
{
    #[Route('/uniqueMonster', name: 'app_unique_monster')]
    public function index(): Response
    {
        return $this->render('unique_monster/index.html.twig', [
            'controller_name' => 'UniqueMonsterController',
        ]);
    }
}
