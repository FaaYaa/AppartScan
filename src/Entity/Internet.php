<?php

namespace App\Entity;

use App\Repository\InternetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InternetRepository::class)]
class Internet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeInternet = null;

    /**
     * @var Collection<int, Location>
     */
    #[ORM\OneToMany(targetEntity: Location::class, mappedBy: 'internet')]
    private Collection $Appartements;

    public function __construct()
    {
        $this->Appartements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeInternet(): ?string
    {
        return $this->TypeInternet;
    }

    public function setTypeInternet(string $TypeInternet): static
    {
        $this->TypeInternet = $TypeInternet;

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getAppartements(): Collection
    {
        return $this->Appartements;
    }

    public function addAppartement(Location $appartement): static
    {
        if (!$this->Appartements->contains($appartement)) {
            $this->Appartements->add($appartement);
            $appartement->setInternet($this);
        }

        return $this;
    }

    public function removeAppartement(Location $appartement): static
    {
        if ($this->Appartements->removeElement($appartement)) {
            // set the owning side to null (unless already changed)
            if ($appartement->getInternet() === $this) {
                $appartement->setInternet(null);
            }
        }

        return $this;
    }
}
