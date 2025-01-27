<?php

namespace App\Controller;

use App\Repository\CollectibleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollectibleController extends AbstractController
{
    private CollectibleRepository $collectibleRepository;

    public function __construct(CollectibleRepository $collectibleRepository){
        $this->collectibleRepository = $collectibleRepository;
    }
    #[Route('/collectible', name: 'app_collectible')]
    public function index(): Response
    {
        $collectibles = $this->collectibleRepository->findAll();

        return $this->render('collectible/index.html.twig', [
            'collectibles' => $collectibles,
        ]);
    }
}
