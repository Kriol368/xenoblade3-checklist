<?php

namespace App\Controller;

use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SkillController extends AbstractController
{
    private SkillRepository $skillRepository;
    public function __construct(SkillRepository $skillRepository){
        $this->skillRepository = $skillRepository;
    }
    #[Route('/skill', name: 'app_skill')]
    public function index(): Response
    {
        $skills = $this->skillRepository->findAll();

        return $this->render('skill/index.html.twig', [
            'skills' => $skills,
        ]);
    }
}
