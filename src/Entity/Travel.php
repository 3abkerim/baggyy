<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TravelRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TravelRepository::class)]
class Travel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /** @phpstan-ignore-next-line */
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $tripDate = null;

    #[ORM\ManyToOne(inversedBy: 'travel')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'travel')]
    private ?City $departureCity = null;

    #[ORM\ManyToOne]
    private ?City $destinationCity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTripDate(): ?DateTimeInterface
    {
        return $this->tripDate;
    }

    public function setTripDate(DateTimeInterface $tripDate): static
    {
        $this->tripDate = $tripDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getDepartureCity(): ?City
    {
        return $this->departureCity;
    }

    public function setDepartureCity(?City $departureCity): static
    {
        $this->departureCity = $departureCity;

        return $this;
    }

    public function getDestinationCity(): ?City
    {
        return $this->destinationCity;
    }

    public function setDestinationCity(?City $destinationCity): static
    {
        $this->destinationCity = $destinationCity;

        return $this;
    }
}
