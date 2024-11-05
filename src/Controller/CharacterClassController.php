<?php

namespace App\Controller;

use App\Entity\CharacterClass;
use App\Repository\CharacterClassRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterClassController extends AbstractController
{
    private CharacterClassRepository $characterClassRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(CharacterClassRepository $characterClassRepository, EntityManagerInterface $entityManager)
    {
        $this->characterClassRepository = $characterClassRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/characterClass', name: 'app_character_class')]
    public function index(): Response
    {
        $characterClasses = $this->characterClassRepository->findAll();

        return $this->render('character_class/index.html.twig', [
            'characterClasses' => $characterClasses,
        ]);
    }

    #[Route('/update-character-status/{id}', name: 'update_character_status', methods: ['POST'])]
    public function updateStatus(int $id, Request $request): JsonResponse
    {
        // Retrieve the UserCharacterClass entity
        $userCharacterClass = $this->userCharacterClassRepository->find($id);

        if (!$userCharacterClass) {
            return new JsonResponse(['success' => false, 'message' => 'User character class not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $field = $data['field'] ?? null;
        $value = $data['value'] ?? null;

        // Valid fields in the UserCharacterClass entity
        $validFields = ['unlocked', 'ascended', 'noah', 'mio', 'eunie', 'taion', 'lanz', 'sena'];

        if ($field && in_array($field, $validFields, true)) {
            $setter = 'set' . ucfirst($field);
            if (method_exists($userCharacterClass, $setter)) {
                $userCharacterClass->$setter((bool)$value);
                $this->entityManager->persist($userCharacterClass);
                $this->entityManager->flush();

                return new JsonResponse(['success' => true]);
            }
        }

        return new JsonResponse(['success' => false, 'message' => 'Invalid field or value'], Response::HTTP_BAD_REQUEST);
    }

}
