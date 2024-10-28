<?php
// src/Controller/FoodController.php
namespace App\Controller;

use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    private FoodRepository $foodRepository;

    public function __construct(FoodRepository $foodRepository)
    {
        $this->foodRepository = $foodRepository;
    }

    #[Route('/food', name: 'app_food')]
    public function index(): Response
    {
        $foods = $this->foodRepository->findAll();

        return $this->render('food/index.html.twig', [
            'foods' => $foods,
        ]);
    }
}
