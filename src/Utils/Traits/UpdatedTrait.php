<?php

declare(strict_types=1);

namespace App\Utils\Traits;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

trait UpdatedTrait
{
    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updated = null;

    #[ORM\Column(nullable: true)]
    private ?int $updatedBy = null;

    public function setUpdated(?DateTimeImmutable $updated = null): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getUpdated(): ?DateTimeImmutable
    {
        return $this->updated;
    }

    public function setUpdatedBy(?int $updatedBy = null): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }
}
