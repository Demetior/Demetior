<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 300)]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $inscriptionDate = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $role = [];

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?bool $isverified = null;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'reviewer')]
    private Collection $reviewed;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?blogger $blogger = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?brand $brand = null;

    public function __construct()
    {
        $this->reviewed = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getInscriptionDate(): ?\DateTimeInterface
    {
        return $this->inscriptionDate;
    }

    public function setInscriptionDate(\DateTimeInterface $inscriptionDate): static
    {
        $this->inscriptionDate = $inscriptionDate;

        return $this;
    }

    public function getRole(): array
    {
        return $this->role;
    }

    public function setRole(array $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function isverified(): ?bool
    {
        return $this->isverified;
    }

    public function setVerified(bool $isverified): static
    {
        $this->isverified = $isverified;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviewed(): Collection
    {
        return $this->reviewed;
    }

    public function addReviewed(Review $reviewed): static
    {
        if (!$this->reviewed->contains($reviewed)) {
            $this->reviewed->add($reviewed);
            $reviewed->setReviewer($this);
        }

        return $this;
    }

    public function removeReviewed(Review $reviewed): static
    {
        if ($this->reviewed->removeElement($reviewed)) {
            // set the owning side to null (unless already changed)
            if ($reviewed->getReviewer() === $this) {
                $reviewed->setReviewer(null);
            }
        }

        return $this;
    }

    public function getBlogger(): ?blogger
    {
        return $this->blogger;
    }

    public function setBlogger(blogger $blogger): static
    {
        $this->blogger = $blogger;

        return $this;
    }

    public function getBrand(): ?brand
    {
        return $this->brand;
    }

    public function setBrand(brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    
}
