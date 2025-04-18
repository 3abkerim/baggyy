<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Travel;
use App\Form\TravelType;
use App\Services\HandleTravelRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TravelController extends AbstractController
{
    public function __construct(
        private readonly HandleTravelRequestService $handleTravelRequestService,
    ) {}

    #[Route('/travel', name: 'travel')]
    public function create(Request $request): Response
    {
        $travel = new Travel();
        $form = $this->createForm(TravelType::class, $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tripData['departureCity'] = $form->get('departure')->getData();
            $tripData['destinationCity'] = $form->get('destination')->getData();
            $tripData['tripDate'] = $form->get('tripDate')->getData();

            $this->handleTravelRequestService->create($travel, $tripData);
        }

        return $this->render('travel/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
