<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\ShopRequest;
use App\Form\ShopRequestType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ShopController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {}

    #[Route('/shop/create', name: 'shop_create')]
    public function create(Request $request): Response
    {
        $shopRequest = new ShopRequest();

        $form = $this->createForm(ShopRequestType::class, $shopRequest);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($shopRequest);
            $this->entityManager->flush();

            $this->addFlash('success', 'Your request has been submitted successfully!');

            return $this->redirectToRoute('shop_success');
        }

        return $this->render('shop/create.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    #[Route('/shop/success', name: 'shop_success')]
    public function requestSuccess(): Response
    {
        return $this->render('shop/success.html.twig');
    }
}
