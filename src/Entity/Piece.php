<?php

namespace App\Entity;

use App\Repository\PieceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PieceRepository::class)]
class Piece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\ManyToOne(inversedBy: 'pieces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    /**
     * @var Collection<int, Equipement>
     */
    #[ORM\OneToMany(targetEntity: Equipement::class, mappedBy: 'piece')]
    private Collection $equipements;

    /**
     * @var Collection<int, Mobilier>
     */
    #[ORM\OneToMany(targetEntity: Mobilier::class, mappedBy: 'piece')]
    private Collection $mobiliers;

    /**
     * @var Collection<int, Electromenager>
     */
    #[ORM\OneToMany(targetEntity: Electromenager::class, mappedBy: 'piece')]
    private Collection $electromenagers;

    /**
     * @var Collection<int, Structure>
     */
    #[ORM\OneToMany(targetEntity: Structure::class, mappedBy: 'piece')]
    private Collection $structures;

    public function __construct()
    {
        $this->equipements = new ArrayCollection();
        $this->mobiliers = new ArrayCollection();
        $this->electromenagers = new ArrayCollection();
        $this->structures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->setPiece($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getPiece() === $this) {
                $equipement->setPiece(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mobilier>
     */
    public function getMobiliers(): Collection
    {
        return $this->mobiliers;
    }

    public function addMobilier(Mobilier $mobilier): static
    {
        if (!$this->mobiliers->contains($mobilier)) {
            $this->mobiliers->add($mobilier);
            $mobilier->setPiece($this);
        }

        return $this;
    }

    public function removeMobilier(Mobilier $mobilier): static
    {
        if ($this->mobiliers->removeElement($mobilier)) {
            // set the owning side to null (unless already changed)
            if ($mobilier->getPiece() === $this) {
                $mobilier->setPiece(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Electromenager>
     */
    public function getElectromenagers(): Collection
    {
        return $this->electromenagers;
    }

    public function addElectromenager(Electromenager $electromenager): static
    {
        if (!$this->electromenagers->contains($electromenager)) {
            $this->electromenagers->add($electromenager);
            $electromenager->setPiece($this);
        }

        return $this;
    }

    public function removeElectromenager(Electromenager $electromenager): static
    {
        if ($this->electromenagers->removeElement($electromenager)) {
            // set the owning side to null (unless already changed)
            if ($electromenager->getPiece() === $this) {
                $electromenager->setPiece(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Structure>
     */
    public function getStructures(): Collection
    {
        return $this->structures;
    }

    public function addStructure(Structure $structure): static
    {
        if (!$this->structures->contains($structure)) {
            $this->structures->add($structure);
            $structure->setPiece($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): static
    {
        if ($this->structures->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getPiece() === $this) {
                $structure->setPiece(null);
            }
        }

        return $this;
    }
}
