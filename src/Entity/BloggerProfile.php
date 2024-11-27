<?php

namespace App\Entity;

use App\Repository\BloggerProfileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BloggerProfileRepository::class)]
class BloggerProfile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 300)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $bio = null;

    #[ORM\Column(length: 300)]
    private ?string $niche = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column]
    private ?int $reach = null;

    #[ORM\Column]
    private ?int $collaborationsCount = null;

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

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getNiche(): ?string
    {
        return $this->niche;
    }

    public function setNiche(string $niche): static
    {
        $this->niche = $niche;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getReach(): ?int
    {
        return $this->reach;
    }

    public function setReach(int $reach): static
    {
        $this->reach = $reach;

        return $this;
    }

    public function getCollaborationsCount(): ?int
    {
        return $this->collaborationsCount;
    }

    public function setCollaborationsCount(int $collaborationsCount): static
    {
        $this->collaborationsCount = $collaborationsCount;

        return $this;
    }
}
