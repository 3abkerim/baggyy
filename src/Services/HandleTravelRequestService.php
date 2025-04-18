<?php

namespace App\Services;

use App\Entity\Travel;
use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

final readonly class HandleTravelRequestService
{
    public function __construct(
        private readonly LocationService $locationService,
        private readonly EntityManagerInterface $entityManager,
        private readonly Security $security,
    ){}

    public function create(Travel $travel, array $tripData): void
    {
        $departureCity = $this->locationService->getOrCreateCityFromString($tripData['departureCity']);
        $destinationCity = $this->locationService->getOrCreateCityFromString($tripData['destinationCity']);

        $tripDateInput = $tripData['tripDate'];
        $isRoundTrip = str_contains($tripDateInput, ' to ');

        $user = $this->security->getUser();

        if (!$user instanceof User) {
            throw new \LogicException('User must be logged in to create a travel.');
        }

        if ($isRoundTrip) {
            [$departureDateStr, $returnDateStr] = explode(' to ', $tripDateInput);

            $departureDate = DateTime::createFromFormat('d-m-Y', trim($departureDateStr));
            $returnDate = DateTime::createFromFormat('d-m-Y', trim($returnDateStr));

            $travel->setDepartureCity($departureCity);
            $travel->setDestinationCity($destinationCity);
            $travel->setTripDate($departureDate);
            $travel->setUser($user);

            $this->entityManager->persist($travel);

            $returnTrip = new Travel();
            $returnTrip->setDepartureCity($destinationCity);
            $returnTrip->setDestinationCity($departureCity);
            $returnTrip->setTripDate($returnDate);
            $returnTrip->setUser($user);

            $this->entityManager->persist($returnTrip);
        } else {
            $departureDate = DateTime::createFromFormat('d-m-Y', trim($tripDateInput));

            $travel->setDepartureCity($departureCity);
            $travel->setDestinationCity($destinationCity);
            $travel->setTripDate($departureDate);
            $travel->setUser($user);

            $this->entityManager->persist($travel);
        }

        $this->entityManager->flush();


    }

}