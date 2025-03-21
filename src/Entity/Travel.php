<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TravelRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: TravelRepository::class)]
#[Broadcast]
class Travel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $tripDate = null;

    #[ORM\ManyToOne(inversedBy: 'travel')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idUser = null;

    #[ORM\ManyToOne(inversedBy: 'travel')]
    private ?City $fromCity = null;

    #[ORM\ManyToOne]
    private ?City $toCity = null;

    #[ORM\ManyToOne]
    private ?Country $fromCountry = null;

    #[ORM\ManyToOne]
    private ?Country $toCountry = null;

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

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getFromCity(): ?City
    {
        return $this->fromCity;
    }

    public function setFromCity(?City $fromCity): static
    {
        $this->fromCity = $fromCity;

        return $this;
    }

    public function getToCity(): ?City
    {
        return $this->toCity;
    }

    public function setToCity(?City $toCity): static
    {
        $this->toCity = $toCity;

        return $this;
    }

    public function getFromCountry(): ?Country
    {
        return $this->fromCountry;
    }

    public function setFromCountry(?Country $fromCountry): static
    {
        $this->fromCountry = $fromCountry;

        return $this;
    }

    public function getToCountry(): ?Country
    {
        return $this->toCountry;
    }

    public function setToCountry(?Country $toCountry): static
    {
        $this->toCountry = $toCountry;

        return $this;
    }
}
