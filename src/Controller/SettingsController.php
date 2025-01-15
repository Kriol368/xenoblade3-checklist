<?php

namespace App\Controller;

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
    public function update_password(Request $request, UserInterface $user, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createFormBuilder()
            ->add('currentPassword', PasswordType::class, [
                'label' => 'Current Password',
                'required' => true,
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'label' => 'New Password',
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
}
