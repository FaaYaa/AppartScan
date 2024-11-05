<?php

namespace App\Entity;

use App\Repository\GazRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GazRepository::class)]
class Gaz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $NumCompteur = null;

    #[ORM\Column]
    private ?int $Releve = null;

    #[ORM\OneToOne(inversedBy: 'gaz', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumCompteur(): ?int
    {
        return $this->NumCompteur;
    }

    public function setNumCompteur(int $NumCompteur): static
    {
        $this->NumCompteur = $NumCompteur;

        return $this;
    }

    public function getReleve(): ?int
    {
        return $this->Releve;
    }

    public function setReleve(int $Releve): static
    {
        $this->Releve = $Releve;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): static
    {
        $this->location = $location;

        return $this;
    }
}
