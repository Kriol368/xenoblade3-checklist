<?php
// src/Controller/ChallengeModeController.php
namespace App\Controller;

use App\Repository\ChallengeModeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChallengeModeController extends AbstractController
{
    private ChallengeModeRepository $challengeModeRepository;

    public function __construct(ChallengeModeRepository $challengeModeRepository)
    {
        $this->challengeModeRepository = $challengeModeRepository;
    }

    #[Route('/challengeMode', name: 'app_challenge_mode')]
    public function index(): Response
    {
        $challengeModes = $this->challengeModeRepository->findAll();

        return $this->render('challenge_mode/index.html.twig', [
            'challengeModes' => $challengeModes,
        ]);
    }
}
