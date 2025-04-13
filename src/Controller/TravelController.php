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
    #[Route('/travel', name: 'travel')]
    public function create(Request $request): Response
    {
        $travel = new Travel();
        $form = $this->createForm(TravelType::class, $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            dump('Submitted ✅');

            if ($form->isValid()) {
                dump('Valid ✅');
            } else {
                dump('Not valid ❌');

                // 🧠 Show all form errors
                foreach ($form->getErrors(true) as $error) {
                    dump($error->getOrigin()->getName() . ': ' . $error->getMessage());
                }
            }
        }

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->isSubmitted(), $form->isValid(), $request->request->all());
        }

        return $this->render('travel/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
