<?php

namespace App\Controller;

use App\Repository\CharacterClassRepository;
use App\Repository\UserCharacterClassRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class CharacterClassController extends AbstractController
{
    private CharacterClassRepository $characterClassRepository;
    private UserCharacterClassRepository $userCharacterClassRepository;
    private EntityManagerInterface $entityManager;
    private CsrfTokenManagerInterface $csrfTokenManager;

    public function __construct(
        CharacterClassRepository     $characterClassRepository,
        UserCharacterClassRepository $userCharacterClassRepository,
        EntityManagerInterface       $entityManager,
        CsrfTokenManagerInterface    $csrfTokenManager // Inject CSRF token manager
    )
    {
        $this->characterClassRepository = $characterClassRepository;
        $this->userCharacterClassRepository = $userCharacterClassRepository;
        $this->entityManager = $entityManager;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    #[Route('/characterClass', name: 'app_character_class')]
    public function index(): Response
    {
        // Retrieve the current user
        $currentUser = $this->getUser();
        if (!$currentUser) {
            throw $this->createAccessDeniedException('User not logged in');
        }

        // Fetch all character classes
        $characterClasses = $this->characterClassRepository->findAll();

        // Fetch UserCharacterClass records for the current user
        $userCharacterClasses = $this->userCharacterClassRepository->findBy(['user' => $currentUser]);

        // Create a mapping of characterClassId to UserCharacterClass
        $userCharacterClassesMap = [];
        foreach ($userCharacterClasses as $userCharacterClass) {
            $charClassId = $userCharacterClass->getCharacterClass()->getId();
            $userCharacterClassesMap[$charClassId] = $userCharacterClass;
        }

        return $this->render('character_class/index.html.twig', [
            'characterClasses' => $characterClasses,
            'userCharacterClassesMap' => $userCharacterClassesMap,
        ]);
    }

    #[Route('/update-character-status/{characterClassId}', name: 'update_character_status', methods: ['POST'])]
    public function updateStatus(int $characterClassId, Request $request): Response
    {
        // Retrieve the current user
        $currentUser = $this->getUser();
        if (!$currentUser) {
            return $this->json(['success' => false, 'error' => 'User not logged in'], Response::HTTP_FORBIDDEN);
        }

        // Fetch the UserCharacterClass entity for the current user and the given character class
        $userCharacterClass = $this->userCharacterClassRepository->findOneBy([
            'user' => $currentUser,
            'characterClass' => $characterClassId
        ]);

        if (!$userCharacterClass) {
            return $this->json(['success' => false, 'error' => 'User character class not found'], Response::HTTP_NOT_FOUND);
        }

        // Validate CSRF token
        $csrfToken = $request->request->get('_csrf_token');
        if (!$this->csrfTokenManager->isTokenValid(new CsrfToken('update_character_status', $csrfToken))) {
            return $this->json(['success' => false, 'error' => 'Invalid CSRF token'], Response::HTTP_FORBIDDEN);
        }

        // Get the field and its new value from the form data
        $field = $request->request->get('field');
        $value = $request->request->get('value');

        // Define allowed fields
        $validFields = ['unlocked', 'ascended', 'noah', 'mio', 'eunie', 'taion', 'lanz', 'sena'];

        if ($field && in_array($field, $validFields, true)) {
            $setter = 'set' . ucfirst($field);
            if (method_exists($userCharacterClass, $setter)) {
                // Update the field's value
                $userCharacterClass->$setter((bool)$value);
                $this->entityManager->persist($userCharacterClass);
                $this->entityManager->flush();

                return $this->json(['success' => true, 'message' => ucfirst($field) . ' status updated']);
            } else {
                return $this->json(['success' => false, 'error' => 'Invalid field'], Response::HTTP_BAD_REQUEST);
            }
        }

        return $this->json(['success' => false, 'error' => 'Invalid request'], Response::HTTP_BAD_REQUEST);
    }
}
