<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Travel;
use App\Form\TravelType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TravelController extends AbstractController
{
    //    public function index(): Response
    //    {
    //
    //    }
    #[Route('/travel', name: 'travel')]
    public function create(Request $request): Response
    {
        $travel = new Travel();
        $form = $this->createForm(TravelType::class, $travel);
        $form->handleRequest($request);

        return $this->render('travel/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
