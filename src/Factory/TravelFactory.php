<?php

namespace App\Factory;

use App\Entity\Travel;

class TravelFactory
{
    public function createFromForm(array $data): array
    {
        [$start, $end] = explode(' to ', $data['tripDate']);

        $departureDate = \DateTime::createFromFormat('d-m-Y', trim($start));
        $returnDate = isset($end) ? \DateTime::createFromFormat('d-m-Y', trim($end)) : null;

        $departure = $this->locationResolver->resolve($data['departure']);
        $destination = $this->locationResolver->resolve($data['destination']);

        $trips = [];

        $tripOut = new Travel();
        $tripOut->setDeparture($departure);
        $tripOut->setDestination($destination);
        $tripOut->setDepartureDate($departureDate);
        $trips[] = $tripOut;

        if ($returnDate) {
            $tripBack = new Travel();
            $tripBack->setDeparture($destination); // reversed
            $tripBack->setDestination($departure);
            $tripBack->setDepartureDate($returnDate);
            $trips[] = $tripBack;
        }

        return $trips;
    }
}