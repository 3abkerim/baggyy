<?php

declare(strict_types=1);

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserSpaceController extends AbstractController
{
    public function __construct(
        private readonly Security $security,
        private readonly EntityManagerInterface $entityManager
    ) {}

    #[Route('/userspace', name: 'userspace')]
    public function index(): Response
    {
        return $this->render('user_space/index.html.twig', [
            'controller_name' => 'UserSpaceController',
        ]);
    }

    #[Route('/account/delete', name: 'account_delete')]
    public function deleteUserAccount(): Response {
        $user = $this->security->getUser();
        $this->entityManager->remove($user);
        $this->entityManager->flush();
        return $this->redirectToRoute('logout');
    }

}
