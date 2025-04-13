<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ShopRequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopRequestRepository::class)]
class ShopRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $productName = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $price = null;

    #[ORM\Column(length: 255)]
    private ?string $productUrl = null;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'idShopRequest')]
    private Collection $images;

    #[ORM\ManyToOne(inversedBy: 'shopRequests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $departureCountry = null;

    #[ORM\ManyToOne(inversedBy: 'shopRequests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?City $destinationCity = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): static
    {
        $this->productName = $productName;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getProductUrl(): ?string
    {
        return $this->productUrl;
    }

    public function setProductUrl(string $productUrl): static
    {
        $this->productUrl = $productUrl;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setIdShopRequest($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getIdShopRequest() === $this) {
                $image->setIdShopRequest(null);
            }
        }

        return $this;
    }

    public function getDepartureCountry(): ?Country
    {
        return $this->departureCountry;
    }

    public function setDepartureCountry(?Country $departureCountry): static
    {
        $this->departureCountry = $departureCountry;

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
