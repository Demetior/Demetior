<?php

namespace App\Entity;

use App\Repository\BloggerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BloggerRepository::class)]
class Blogger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $birthDate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $bio = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $location = null;

    #[ORM\Column(nullable: true)]
    private ?array $platforms = null;

    #[ORM\Column(nullable: true)]
    private ?int $collaborationsCount = null;

    #[ORM\OneToOne(mappedBy: 'blogger', cascade: ['persist', 'remove'])]
    private ?User $user = null;

   
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeImmutable $birthDate): static
    {
        $this->birthDate = $birthDate;

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


    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getPlatforms(): ?array
    {
        return $this->platforms;
    }

    public function setPlatforms(?array $platforms): static
    {
        $this->platforms = $platforms;

        return $this;
    }

    public function getCollaborationsCount(): ?int
    {
        return $this->collaborationsCount;
    }

    public function setCollaborationsCount(?int $collaborationsCount): static
    {
        $this->collaborationsCount = $collaborationsCount;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        // set the owning side of the relation if necessary
        if ($user->getBlogger() !== $this) {
            $user->setBlogger($this);
        }

        $this->user = $user;

        return $this;
    }

}
