<?php

namespace App\Services;

use App\Entity\City;
use App\Entity\Country;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Location;

final readonly class LocationService
{
    public function __construct(
        private CountryRepository $countryRepository,
        private CityRepository $cityRepository,
        private EntityManagerInterface $entityManager,
    )
    {
    }

    public function handleCity(string $cityName, Country $country): City
    {
        $city = $this->cityRepository->findOneBy(['name' => $cityName, 'country' => $country]);

        if (!$city) {
            $city = new City();
            $city->setName($cityName);
            $city->setCountry($country);
            $this->entityManager->persist($city);
            $this->entityManager->flush();
        }

        return $city;
    }

    public function handleCountry($countryName): Country
    {
        $country = $this->countryRepository->findOneBy(['name' => $countryName]);

        if (!$country){
            $country = new Country();
            $country->setName($countryName);
            $this->entityManager->persist($country);
        }

        return $country;
    }

}