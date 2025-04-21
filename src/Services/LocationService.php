<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\State;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use App\Repository\StateRepository;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;

final readonly class LocationService
{
    public function __construct(
        private CountryRepository $countryRepository,
        private CityRepository $cityRepository,
        private StateRepository $stateRepository,
        private EntityManagerInterface $entityManager,
    ) {}

    public function getOrCreateCityFromString(string $location): City
    {
        $parts = array_map('trim', explode(',', $location));

        $cityName = $parts[0];
        $stateName = 3 === count($parts) ? $parts[1] : null;
        $countryName = $parts[count($parts) - 1] ?? null;

        if (!$cityName || !$countryName) {
            throw new InvalidArgumentException('Invalid location format: '.$location);
        }

        $country = $this->handleCountry($countryName);
        $city = $this->handleCity($cityName, $country);

        $state = null;
        if ($stateName) {
            $state = $this->handleState($stateName, $country);
        }

        if ($state instanceof State) {
            $city->setState($state);
        }

        $this->entityManager->flush();

        return $city;
    }

    public function handleCity(string $cityName, Country $country): City
    {
        $city = $this->cityRepository->findOneBy(['name' => $cityName, 'country' => $country]);

        if (null === $city) {
            $city = new City();
            $city->setName($cityName);
            $city->setCountry($country);
            $this->entityManager->persist($city);
        }

        return $city;
    }

    public function handleCountry(string $countryName): Country
    {
        $country = $this->countryRepository->findOneBy(['name' => $countryName]);

        if (null === $country) {
            $country = new Country();
            $country->setName($countryName);
            $this->entityManager->persist($country);
        }

        return $country;
    }

    public function handleState(string $stateName, Country $country): State
    {
        $state = $this->stateRepository->findOneBy(['name' => $stateName, 'country' => $country]);

        if (null === $state) {
            $state = new State();
            $state->setName($stateName);
            $state->setCountry($country);
            $this->entityManager->persist($state);
        }

        return $state;
    }
}
