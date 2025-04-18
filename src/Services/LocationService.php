<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\City;
use App\Entity\Country;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;

final readonly class LocationService
{
    public function __construct(
        private CountryRepository $countryRepository,
        private CityRepository $cityRepository,
        private EntityManagerInterface $entityManager,
    ) {}

    public function getOrCreateCityFromString(string $location): City
    {
        $parts = array_map('trim', explode(',', $location));

        $cityName = $parts[0] ?? null;
        //        $regionName = count($parts) === 3 ? $parts[1] : null;
        $countryName = $parts[count($parts) - 1] ?? null;

        if (!$cityName || !$countryName) {
            throw new InvalidArgumentException("Invalid location format: $location");
        }

        $country = $this->handleCountry($countryName);
        $city = $this->handleCity($cityName, $country);
        // todo:handle region

        $this->entityManager->flush();

        return $city;
    }

    public function handleCity(string $cityName, Country $country): City
    {
        $city = $this->cityRepository->findOneBy(['name' => $cityName, 'country' => $country]);

        if (!$city) {
            $city = new City();
            $city->setName($cityName);
            $city->setCountry($country);
            $this->entityManager->persist($city);
        }

        return $city;
    }

    public function handleCountry($countryName): Country
    {
        $country = $this->countryRepository->findOneBy(['name' => $countryName]);

        if (!$country) {
            $country = new Country();
            $country->setName($countryName);
            $this->entityManager->persist($country);
        }

        return $country;
    }
}
