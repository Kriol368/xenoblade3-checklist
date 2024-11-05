<?php

namespace App\Controller;

use App\Entity\CharacterClass;
use App\Repository\CharacterClassRepository;
use App\Repository\UserCharacterClassRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Csrf\CsrfToken;

class CharacterClassController extends AbstractController
{
    private CharacterClassRepository $characterClassRepository;
    private UserCharacterClassRepository $userCharacterClassRepository;
    private EntityManagerInterface $entityManager;
    private CsrfTokenManagerInterface $csrfTokenManager;

    public function __construct(
        CharacterClassRepository $characterClassRepository,
        UserCharacterClassRepository $userCharacterClassRepository,
        EntityManagerInterface $entityManager,
        CsrfTokenManagerInterface $csrfTokenManager // Inject CSRF token manager
    ) {
        $this->characterClassRepository = $characterClassRepository;
        $this->userCharacterClassRepository = $userCharacterClassRepository;
        $this->entityManager = $entityManager;
        $this->csrfTokenManager = $csrfTokenManager; // Store it in a property for use
    }

    #[Route('/characterClass', name: 'app_character_class')]
    public function index(): Response
    {
        // Assuming you have a way to get the current user
        $currentUser = $this->getUser();

        // Fetch all character classes
        $characterClasses = $this->characterClassRepository->findAll();

        // Fetch UserCharacterClass records for the current user
        $userCharacterClasses = $this->userCharacterClassRepository->findBy(['user' => $currentUser]);

        return $this->render('character_class/index.html.twig', [
            'characterClasses' => $characterClasses,
            'userCharacterClasses' => $userCharacterClasses,
        ]);
    }

    #[Route('/update-character-status/{id}', name: 'update_character_status', methods: ['POST'])]
    public function updateStatus(int $id, Request $request): Response
    {
        // Retrieve the UserCharacterClass entity
        $userCharacterClass = $this->userCharacterClassRepository->find($id);

        if (!$userCharacterClass) {
            $this->addFlash('error', 'User character class not found');
            return $this->redirectToRoute('app_character_class');
        }

        // Get the field and its new value from the form data
        $field = $request->request->get('field');
        $value = $request->request->get('value');

        // Define allowed fields
        $validFields = ['unlocked', 'ascended', 'noah', 'mio', 'eunie', 'taion', 'lanz', 'sena'];

        if ($field && in_array($field, $validFields, true)) {
            $setter = 'set' . ucfirst($field);
            if (method_exists($userCharacterClass, $setter)) {
                $userCharacterClass->$setter((bool)$value);
                $this->entityManager->persist($userCharacterClass);
                $this->entityManager->flush();

                $this->addFlash('success', ucfirst($field) . ' status updated');
            } else {
                $this->addFlash('error', 'Invalid field');
            }
        } else {
            $this->addFlash('error', 'Invalid request');
        }

        return $this->redirectToRoute('app_character_class');
    }

}
