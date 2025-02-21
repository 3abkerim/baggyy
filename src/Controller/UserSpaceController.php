<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserSpaceController extends AbstractController
{
    #[Route('/userspace', name: 'userspace')]
    public function index(): Response
    {
        return $this->render('user_space/index.html.twig', [
            'controller_name' => 'UserSpaceController',
        ]);
    }
}
