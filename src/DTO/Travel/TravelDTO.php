<?php

namespace App\DTO\Travel;

use DateTimeImmutable;

final class TravelDTO
{
    private ?string $departure;
    private ?string $destination;
    private ?DateTimeImmutable $date;
    private ?int $idTraveller;

    public function __construct(
        ?string $departure = null,
        ?string $destination = null,
        ?DateTimeImmutable $date = null,
        ?int $idTraveller = null
    ) {
        $this->departure = $departure;
        $this->destination = $destination;
        $this->date = $date;
        $this->idTraveller = $idTraveller;
    }

    public function getDeparture(): ?string
    {
        return $this->departure;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function getDate(): ?DateTimeImmutable
    {
        return $this->date;
    }

    public function getIdTraveller(): ?int
    {
        return $this->idTraveller;
    }

    public function setDeparture(?string $departure): void
    {
        $this->departure = $departure;
    }

    public function setDestination(?string $destination): void
    {
        $this->destination = $destination;
    }

    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    public function setIdTraveller(?int $idTraveller): void
    {
        $this->idTraveller = $idTraveller;
    }
}
