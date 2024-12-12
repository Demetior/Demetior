<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 300)]
    private ?string $name = null;

    #[ORM\Column(length: 300)]
    private ?string $industry = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $location = null;

    #[ORM\Column(length: 300)]
    private ?string $website = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $previousCampaigns = null;

    #[ORM\OneToOne(mappedBy: 'brand', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    /**
     * @var Collection<int, campaign>
     */
    #[ORM\OneToMany(targetEntity: campaign::class, mappedBy: 'brand')]
    private Collection $campaign;

    public function __construct()
    {
        $this->campaign = new ArrayCollection();
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

    public function getIndustry(): ?string
    {
        return $this->industry;
    }

    public function setIndustry(string $industry): static
    {
        $this->industry = $industry;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): static
    {
        $this->website = $website;

        return $this;
    }

    public function getPreviousCampaigns(): ?array
    {
        return $this->previousCampaigns;
    }

    public function setPreviousCampaigns(?array $previousCampaigns): static
    {
        $this->previousCampaigns = $previousCampaigns;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        // set the owning side of the relation if necessary
        if ($user->getBrand() !== $this) {
            $user->setBrand($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, campaign>
     */
    public function getCampaign(): Collection
    {
        return $this->campaign;
    }

    public function addCampaign(campaign $campaign): static
    {
        if (!$this->campaign->contains($campaign)) {
            $this->campaign->add($campaign);
            $campaign->setBrand($this);
        }

        return $this;
    }

    public function removeCampaign(campaign $campaign): static
    {
        if ($this->campaign->removeElement($campaign)) {
            // set the owning side to null (unless already changed)
            if ($campaign->getBrand() === $this) {
                $campaign->setBrand(null);
            }
        }

        return $this;
    }

}
