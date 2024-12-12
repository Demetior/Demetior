<?php

namespace App\Entity;

use App\Repository\CollaborationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollaborationRepository::class)]
class Collaboration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private array $agreement = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAgreement(): array
    {
        return $this->agreement;
    }

    public function setAgreement(array $agreement): static
    {
        $this->agreement = $agreement;

        return $this;
    }
}
