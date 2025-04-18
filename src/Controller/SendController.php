<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\SendRequestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SendController extends AbstractController
{
    #[Route('/send', name: 'send')]
    public function create(Request $request): Response
    {
        $form = $this->createForm(SendRequestType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
        }

        return $this->render('send/create.html.twig', [
            'controller_name' => 'SendController',
            'form' => $form->createView(),
        ]);
    }
}
