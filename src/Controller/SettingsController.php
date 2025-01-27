<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;

final class SettingsController extends AbstractController
{
    #[Route('/settings', name: 'app_settings')]
    public function index(): Response
    {
        return $this->render('settings/index.html.twig', [
        ]);
    }

    #[Route('/settings/update_profile', name: 'app_settings_update')]
    public function update_profile(Request $request, UserInterface $user, EntityManagerInterface $entityManager): Response
    {
        // Create the form
        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class, [
                'label' => 'Name',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Update Profile',
                'attr' => ['class' => 'btn btn-primary'],
            ])
            ->getForm();

        // Handle form submission
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            // Add flash message for user feedback
            $this->addFlash('success', 'Profile updated successfully.');

            return $this->redirectToRoute('app_settings');
        }

        return $this->render('settings/update_profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/settings/update_password', name: 'app_settings_update_password')]
    public function update_password(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
    ): Response {
        // Retrieve the currently authenticated user
        $user = $this->getUser();

        if (!$user) {
            // Redirect or handle the case where there is no authenticated user
            $this->addFlash('error', 'You must be logged in to update your password.');

            return $this->redirectToRoute('app_login');
        }

        $form = $this->createFormBuilder()
            ->add('currentPassword', PasswordType::class, [
                'label' => 'Current Password',
                'required' => true,
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'New Password'],
                'second_options' => ['label' => 'Confirm New Password'],
                'required' => true,
                'invalid_message' => 'The password fields must match.',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Update Password',
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Verify current password
            if (!$userPasswordHasher->isPasswordValid($user, $data['currentPassword'])) {
                $this->addFlash('error', 'Current password is incorrect.');
            } else {
                // Hash new password
                $newPassword = $userPasswordHasher->hashPassword($user, $data['newPassword']);
                $user->setPassword($newPassword); // Set the new password

                // Persist the changes
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Password updated successfully.');

                return $this->redirectToRoute('app_settings_update_password');
            }
        }

        return $this->render('settings/update_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/settings/reset', name: 'app_reset')]
    public function reset(): Response
    {
        return $this->render('settings/reset_account.html.twig', [
        ]);
    }

    #[Route('/settings/reset_account', name: 'app_reset_account')]
    public function resetAccount(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser(); // Get the current logged-in user

        if (!$user) {
            $this->addFlash('error', 'You must be logged in to reset your account.');

            return $this->redirectToRoute('app_home');
        }

        // Reset related entities
        $this->resetUserRelatedData($user, $entityManager);

        // Add success message and redirect to a relevant page
        $this->addFlash('success', 'Your account has been reset successfully.');

        return $this->redirectToRoute('app_home');
    }

    #[Route('/settings/delete_account', name: 'app_settings_delete_account')]
    public function delete_account(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        // Retrieve the currently authenticated user
        $currentUser = $this->getUser();

        if (!$currentUser) {
            $this->addFlash('error', 'You must be logged in to delete your account.');
            return $this->redirectToRoute('app_login');
        }

        // Reload the user from the database to ensure it's fully hydrated
        $user = $entityManager->getRepository(User::class)->find($currentUser->getId());
        if (!$user) {
            $this->addFlash('error', 'User not found.');
            return $this->redirectToRoute('app_home');
        }

        // CSRF token for security
        if ($this->isCsrfTokenValid('delete_account', $request->get('_token'))) {
            $relatedTables = [
                'App\Entity\UserChallengeMode',
                'App\Entity\UserCharacterClass',
                'App\Entity\UserGauntletEmblem',
                'App\Entity\UserGem',
                'App\Entity\UserLandmarkLocation',
                'App\Entity\UserQuest',
                'App\Entity\UserSoulTree',
                'App\Entity\UserUniqueMonster',
            ];

            foreach ($relatedTables as $table) {
                $entityManager->createQuery(
                    "DELETE FROM $table t WHERE t.user = :user"
                )
                    ->setParameter('user', $user)
                    ->execute();
            }

            // Delete the user
            $entityManager->remove($user);
            $entityManager->flush();

            $this->addFlash('success', 'Your account and all associated data have been deleted.');
            return $this->redirectToRoute('app_login');
        }

        $this->addFlash('error', 'Invalid request. Please try again.');
        return $this->redirectToRoute('app_settings_delete_account');
    }



    private function resetUserRelatedData(User $user, EntityManagerInterface $entityManager): void
    {
        $relatedEntities = [
            'UserChallengeMode' => ['easy', 'normal', 'hard'],
            'UserCharacterClass' => ['unlocked', 'ascended', 'noah', 'mio', 'eunie', 'taion', 'lanz', 'sena'],
            'UserGauntletEmblem' => ['checked'],
            'UserGem' => ['checked'],
            'UserLandmarkLocation' => ['checked'],
            'UserQuest' => ['checked'],
            'UserSoulTree' => ['checked'],
            'UserUniqueMonster' => ['defeated', 'soulHacked', 'abilityUpgraded'],
        ];

        foreach ($relatedEntities as $entityClass => $fields) {
            // Ensure the full namespace for the entity class
            $class = "App\\Entity\\$entityClass";

            // Build the query to update the fields
            $queryBuilder = $entityManager->createQueryBuilder()
                ->update($class, 'e')
                ->where('e.user = :userId')
                ->setParameter('userId', $user->getId());

            foreach ($fields as $field) {
                $queryBuilder->set("e.$field", ':defaultValue')
                    ->setParameter('defaultValue', 0);
            }

            // Execute the query
            $queryBuilder->getQuery()->execute();
        }
    }
}
