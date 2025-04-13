<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ImageRepository;
use App\Utils\Traits\CreatedTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    use CreatedTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $alt = null;

    #[ORM\Column]
    private ?bool $isMain = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?ShopRequest $idShopRequest = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): static
    {
        $this->alt = $alt;

        return $this;
    }

    public function isMain(): ?bool
    {
        return $this->isMain;
    }

    public function setIsMain(bool $isMain): static
    {
        $this->isMain = $isMain;

        return $this;
    }

    public function getIdShopRequest(): ?ShopRequest
    {
        return $this->idShopRequest;
    }

    public function setIdShopRequest(?ShopRequest $idShopRequest): static
    {
        $this->idShopRequest = $idShopRequest;

        return $this;
    }
}
