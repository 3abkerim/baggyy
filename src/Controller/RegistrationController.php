<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $userPasswordHasher,
    ) {}

    #[Route('/register', name: 'register')]
    public function create(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('userspace');
        }

        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (null === $user->getPassword() || '' === trim($user->getPassword())) {
                return new Response('Password cannot be empty', Response::HTTP_BAD_REQUEST);
            }

            $hashedPassword = $this->userPasswordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);
            $user->setRoles(['ROLE_USER']);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
