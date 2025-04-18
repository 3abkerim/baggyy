<?php

namespace App\Tests\Service;

use App\Entity\City;
use App\Entity\Travel;
use App\Entity\User;
use App\Services\HandleTravelRequestService;
use App\Services\LocationService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\SecurityBundle\Security;

class HandleTravelRequestServiceTest extends TestCase
{
    public function testCreateOneWayTrip(): void
    {
        $departureCityName = 'Paris';
        $destinationCityName = 'Lyon';
        $tripDate = '17-04-2025';

        $departureCity = $this->createMock(City::class);
        $destinationCity = $this->createMock(City::class);
        $travel = new Travel();
        $user = $this->createMock(User::class);

        $locationService = $this->createMock(LocationService::class);
        $locationService->expects($this->exactly(2))
            ->method('getOrCreateCityFromString')
            ->withConsecutive([$departureCityName], [$destinationCityName])
            ->willReturnOnConsecutiveCalls($departureCity, $destinationCity);

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->once())
            ->method('persist')
            ->with($this->callback(function (Travel $travel) use ($departureCity, $destinationCity, $tripDate, $user) {
                return
                    $travel->getDepartureCity() === $departureCity &&
                    $travel->getDestinationCity() === $destinationCity &&
                    $travel->getTripDate()->format('d-m-Y') === $tripDate &&
                    $travel->getUser() === $user;
            }));

        $entityManager->expects($this->once())->method('flush');

        $security = $this->createMock(Security::class);
        $security->method('getUser')->willReturn($user);

        // Service
        $service = new HandleTravelRequestService($locationService, $entityManager, $security);

        // Input data
        $tripData = [
            'departureCity' => $departureCityName,
            'destinationCity' => $destinationCityName,
            'tripDate' => $tripDate
        ];

        $service->create($travel, $tripData);
    }

    public function testCreateRoundTrip(): void
    {
        $departureCity = $this->createMock(City::class);
        $destinationCity = $this->createMock(City::class);
        $user = $this->createMock(User::class);
        $travel = new Travel();
        $tripDate = '17-04-2025 to 24-04-2025';

        $locationService = $this->createMock(LocationService::class);
        $locationService->expects($this->exactly(2))
            ->method('getOrCreateCityFromString')
            ->willReturnOnConsecutiveCalls($departureCity, $destinationCity);

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->exactly(2))->method('persist');
        $entityManager->expects($this->once())->method('flush');

        $security = $this->createMock(Security::class);
        $security->method('getUser')->willReturn($user);

        $service = new HandleTravelRequestService($locationService, $entityManager, $security);

        $tripData = [
            'departureCity' => 'Paris',
            'destinationCity' => 'Lyon',
            'tripDate' => $tripDate
        ];

        $service->create($travel, $tripData);
    }
}
