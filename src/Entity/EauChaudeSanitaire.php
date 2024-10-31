<?php

namespace App\Entity;

use App\Repository\EauChaudeSanitaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EauChaudeSanitaireRepository::class)]
class EauChaudeSanitaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeEauChaude = null;

    /**
     * @var Collection<int, Location>
     */
    #[ORM\ManyToMany(targetEntity: Location::class, inversedBy: 'eauChaudeSanitaires')]
    private Collection $locations;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeEauChaude(): ?string
    {
        return $this->TypeEauChaude;
    }

    public function setTypeEauChaude(string $TypeEauChaude): static
    {
        $this->TypeEauChaude = $TypeEauChaude;

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLocation(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $locations): static
    {
        if (!$this->locations->contains($locations)) {
            $this->locations->add($locations);
        }

        return $this;
    }

    public function removeLocation(Location $locations): static
    {
        $this->locations->removeElement($locations);

        return $this;
    }
}
