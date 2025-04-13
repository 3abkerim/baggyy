<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SendController extends AbstractController
{
    #[Route('/send', name: 'send')]
    public function index(): Response
    {
        return $this->render('create.html.twig', [
            'controller_name' => 'SendController',
        ]);
    }
}
