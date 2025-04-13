<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: CityRepository::class)]
#[Broadcast]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /** @phpstan-ignore-next-line */
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'cities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $country = null;

    /**
     * @var Collection<int, ShopRequest>
     */
    #[ORM\OneToMany(targetEntity: ShopRequest::class, mappedBy: 'destinationCity')]
    private Collection $shopRequests;

    public function __construct()
    {
        $this->shopRequests = new ArrayCollection();
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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): static
    {
        $this->country = $country;

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
            $shopRequest->setDestinationCity($this);
        }

        return $this;
    }

    public function removeShopRequest(ShopRequest $shopRequest): static
    {
        if ($this->shopRequests->removeElement($shopRequest)) {
            // set the owning side to null (unless already changed)
            if ($shopRequest->getDestinationCity() === $this) {
                $shopRequest->setDestinationCity(null);
            }
        }

        return $this;
    }
}
