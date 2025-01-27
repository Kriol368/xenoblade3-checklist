<?php

namespace App\Controller;

use App\Repository\ArtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtController extends AbstractController
{
    private ArtRepository $artRepository;
    public function __construct(ArtRepository $artRepository){
        $this->artRepository = $artRepository;
    }
    #[Route('/art', name: 'app_art')]
    public function index(): Response
    {
        $arts = $this->artRepository->findAll();

        return $this->render('art/index.html.twig', [
            'arts' => $arts,
        ]);
    }
}
