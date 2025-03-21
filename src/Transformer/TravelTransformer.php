<?php

namespace App\Transformer;

use App\DTO\Travel\TravelDTO;
use App\Entity\Travel;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TravelTransformer
{
    public function __construct(

    ){}

    public function transform($value): ?TravelDTO
    {
        if (null === $value) {
            return null;
        }

        if ($value instanceof Travel) {
            throw new TransformationFailedException('Expecting an instance of Travel');
        }

        $travelDTO = new TravelDTO();
        $travelDTO->setDate($value->getTripDate);

        return $travelDTO;

    }

    public function reverseTransform($value): ?Travel
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof TravelDTO) {
            throw new TransformationFailedException('Expecting an instance of TravelDTO');
        }

        $travelEntity = new Travel();
        $travelEntity->setTripDate($value->getDate());



    }

}