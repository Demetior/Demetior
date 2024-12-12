<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
class Blog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $blogName = null;

    #[ORM\Column(length: 255)]
    private ?string $niche = null;

    #[ORM\Column(length: 500)]
    private ?string $website = null;

    #[ORM\Column]
    private ?int $reach = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlogName(): ?string
    {
        return $this->blogName;
    }

    public function setBlogName(string $blogName): static
    {
        $this->blogName = $blogName;

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

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): static
    {
        $this->website = $website;

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
}
