<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Travel;
use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use SebastianBergmann\Template\RuntimeException;
use Symfony\Bundle\SecurityBundle\Security;

final readonly class TravelRequestCreationService
{
    public function __construct(
        private readonly LocationService $locationService,
        private readonly EntityManagerInterface $entityManager,
        private readonly Security $security,
    ) {}

    /**
     * Creates a travel record and its optional return trip.
     *
     * Retrieves departure and destination cities, validates the current user,
     * and determines if the travel is a one-way trip or a round trip.
     *
     * If the trip is a round trip, it creates and persists both the departure
     * and return trip records. For one-way trips, it creates and persists
     * only the departure record.
     *
     * Flushes changes to the database after persisting the travel data.
     *
     * @param Travel                                                                  $travel   the travel entity to be persisted
     * @param array{departureCity: string, destinationCity: string, tripDate: string} $tripData an associative array containing trip information
     *
     * @throws LogicException if the user is not authenticated
     */
    public function createTravelRequest(Travel $travel, array $tripData): void
    {
        $departureCity = $this->locationService->getOrCreateCityFromString($tripData['departureCity']);
        $destinationCity = $this->locationService->getOrCreateCityFromString($tripData['destinationCity']);

        $tripDateInput = $tripData['tripDate'];
        $isRoundTrip = str_contains((string) $tripDateInput, ' to ');

        $user = $this->security->getUser();

        if (!$user instanceof User) {
            throw new LogicException('User must be logged in to create a travel.');
        }

        if ($isRoundTrip) {
            [$departureDateStr, $returnDateStr] = explode(' to ', (string) $tripDateInput);

            $departureDate = DateTime::createFromFormat('d-m-Y', trim($departureDateStr));
            if (!$departureDate) {
                throw new RuntimeException('Invalid departure date format. Expected format: DD-MM-YYYY to DD-MM-YYYY');
            }

            $returnDate = DateTime::createFromFormat('d-m-Y', trim($returnDateStr));
            if (!$returnDate) {
                throw new RuntimeException('Invalid return date format.');
            }

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
            $departureDate = DateTime::createFromFormat('d-m-Y', trim((string) $tripDateInput));
            if (!$departureDate) {
                throw new RuntimeException('Invalid departure date format. Expected format: DD-MM-YYYY');
            }

            $travel->setDepartureCity($departureCity);
            $travel->setDestinationCity($destinationCity);
            $travel->setTripDate($departureDate);
            $travel->setUser($user);

            $this->entityManager->persist($travel);
        }

        $this->entityManager->flush();
    }
}
