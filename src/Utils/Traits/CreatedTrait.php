<?php

declare(strict_types=1);

namespace App\Utils\Traits;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

trait CreatedTrait
{
    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $created = null;

    #[ORM\Column(nullable: true)]
    private ?int $createdBy = null;

    public function setCreated(?DateTimeImmutable $created = null): self
    {
        $this->created = $created;

        return $this;
    }

    public function getCreated(): ?DateTimeImmutable
    {
        return $this->created;
    }

    public function setCreatedBy(?int $createdBy = null): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }
}
