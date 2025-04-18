<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[Broadcast]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /** @phpstan-ignore-next-line */
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $name = null;

    /**
     * @var Collection<int, City>
     */
    #[ORM\OneToMany(targetEntity: City::class, mappedBy: 'country')]
    private Collection $cities;

    /**
     * @var Collection<int, ShopRequest>
     */
    #[ORM\OneToMany(targetEntity: ShopRequest::class, mappedBy: 'departureCountry')]
    private Collection $shopRequests;

    /**
     * @var Collection<int, State>
     */
    #[ORM\OneToMany(targetEntity: State::class, mappedBy: 'country')]
    private Collection $states;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
        $this->shopRequests = new ArrayCollection();
        $this->states = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, City>
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): static
    {
        if (!$this->cities->contains($city)) {
            $this->cities->add($city);
            $city->setCountry($this);
        }

        return $this;
    }

    public function removeCity(City $city): static
    {
        // set the owning side to null (unless already changed)
        if ($this->cities->removeElement($city) && $city->getCountry() === $this) {
            $city->setCountry(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, ShopRequest>
     */
    public function getShopRequests(): Collection
    {
        return $this->shopRequests;
    }

    public function addShopRequest(ShopRequest $shopRequest): static
    {
        if (!$this->shopRequests->contains($shopRequest)) {
            $this->shopRequests->add($shopRequest);
            $shopRequest->setDepartureCountry($this);
        }

        return $this;
    }

    public function removeShopRequest(ShopRequest $shopRequest): static
    {
        if ($this->shopRequests->removeElement($shopRequest)) {
            // set the owning side to null (unless already changed)
            if ($shopRequest->getDepartureCountry() === $this) {
                $shopRequest->setDepartureCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, State>
     */
    public function getStates(): Collection
    {
        return $this->states;
    }

    public function addState(State $state): static
    {
        if (!$this->states->contains($state)) {
            $this->states->add($state);
            $state->setCountry($this);
        }

        return $this;
    }

    public function removeState(State $state): static
    {
        if ($this->states->removeElement($state)) {
            // set the owning side to null (unless already changed)
            if ($state->getCountry() === $this) {
                $state->setCountry(null);
            }
        }

        return $this;
    }
}
